<?php

namespace App\Http\Controllers;

use App\QualityFollowup;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QualityController extends Controller
{
    /**
     * لوحة تحكم الجودة
     */
    public function dashboard()
    {
        $stats = [
            'total' => QualityFollowup::count(),
            'pending' => QualityFollowup::where('status', 'pending')->count(),
            'completed' => QualityFollowup::where('status', 'completed')->count(),
            'needs_improvement' => QualityFollowup::where('status', 'needs_improvement')->count(),
            'average_rating' => QualityFollowup::avg('rating') ?? 0,
        ];
        
        $recentFollowups = QualityFollowup::with(['order.service', 'order.technician', 'qualityAgent'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('quality.dashboard', compact('stats', 'recentFollowups'));
    }

    /**
     * عرض متابعات الجودة
     */
    public function followups(Request $request)
    {
        $query = QualityFollowup::with(['order.service', 'order.technician', 'qualityAgent']);
        
        // فلترة حسب الحالة
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // فلترة حسب الطلب
        if ($request->has('order_id') && $request->order_id) {
            $query->where('order_id', $request->order_id);
        }
        
        $followups = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('quality.followups.index', compact('followups'));
    }

    /**
     * عرض نموذج إنشاء متابعة جودة
     */
    public function create($order_id)
    {
        $order = Order::with(['service', 'technician'])->findOrFail($order_id);
        
        // التحقق من أن الطلب مكتمل
        if ($order->status != 2) {
            return redirect()->back()->with('error', __('Order must be completed to create quality followup'));
        }
        
        return view('quality.followups.create', compact('order'));
    }

    /**
     * حفظ متابعة الجودة
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'notes' => 'nullable|string|max:2000',
            'client_feedback' => 'nullable|string|max:2000',
            'technician_feedback' => 'nullable|string|max:2000',
            'status' => 'required|in:pending,completed,needs_improvement',
        ]);
        
        $order = Order::findOrFail($request->order_id);
        
        // التحقق من أن الطلب مكتمل
        if ($order->status != 2) {
            return redirect()->back()->with('error', __('Order must be completed'));
        }
        
        $followup = QualityFollowup::create([
            'order_id' => $request->order_id,
            'created_by' => Auth::id(),
            'rating' => $request->rating,
            'notes' => $request->notes,
            'client_feedback' => $request->client_feedback,
            'technician_feedback' => $request->technician_feedback,
            'status' => $request->status,
        ]);
        
        // تحديث تقييم الفني إذا كان موجوداً
        if ($order->technician) {
            $this->updateTechnicianRating($order->technician);
        }
        
        return redirect()->route('quality.followups')->with('success', __('Quality followup created successfully'));
    }

    /**
     * عرض متابعة الجودة
     */
    public function show($id)
    {
        $followup = QualityFollowup::with(['order.service', 'order.technician', 'qualityAgent'])
            ->findOrFail($id);
        
        return view('quality.followups.show', compact('followup'));
    }

    /**
     * تحديث متابعة الجودة
     */
    public function update(Request $request, $id)
    {
        $followup = QualityFollowup::findOrFail($id);
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'notes' => 'nullable|string|max:2000',
            'client_feedback' => 'nullable|string|max:2000',
            'technician_feedback' => 'nullable|string|max:2000',
            'status' => 'required|in:pending,completed,needs_improvement',
        ]);
        
        $followup->rating = $request->rating;
        $followup->notes = $request->notes;
        $followup->client_feedback = $request->client_feedback;
        $followup->technician_feedback = $request->technician_feedback;
        $followup->status = $request->status;
        $followup->save();
        
        // تحديث تقييم الفني
        if ($followup->order->technician) {
            $this->updateTechnicianRating($followup->order->technician);
        }
        
        return redirect()->route('quality.followups.show', $id)->with('success', __('Quality followup updated successfully'));
    }

    /**
     * تحديث تقييم الفني
     */
    private function updateTechnicianRating($technician)
    {
        $followups = QualityFollowup::whereHas('order', function($query) use ($technician) {
            $query->where('seller_id', $technician->id);
        })->get();
        
        if ($followups->count() > 0) {
            $averageRating = $followups->avg('rating');
            $technician->rating = round($averageRating, 2);
            $technician->save();
        }
    }

    /**
     * عرض الملف الشخصي
     */
    public function profile()
    {
        $user = Auth::user();
        
        // سجل العمليات - متابعات الجودة التي أنشأها
        $activities = \App\QualityFollowup::where('created_by', $user->id)
            ->with(['order.service', 'order.technician', 'qualityAgent'])
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        
        return view('quality.profile', compact('user', 'activities'));
    }

    /**
     * تحديث الملف الشخصي
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
        ]);
        
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->save();
        
        return redirect()->back()->with('success', __('Profile updated successfully'));
    }
}

