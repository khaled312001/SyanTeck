<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * عرض لوحة تحكم الدعم
     */
    public function index()
    {
        $orders = Order::with(['service', 'technician', 'region'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 0)->count(),
            'active' => Order::where('status', 1)->count(),
            'completed' => Order::where('status', 2)->count(),
            'cancelled' => Order::where('status', 4)->count(),
        ];
        
        return view('support.dashboard', compact('orders', 'stats'));
    }

    /**
     * عرض جميع الطلبات
     */
    public function orders(Request $request)
    {
        $query = Order::with(['service', 'technician', 'region']);
        
        // فلترة حسب الحالة
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // فلترة حسب المنطقة
        if ($request->has('region_id') && $request->region_id) {
            $query->where('region_id', $request->region_id);
        }
        
        // فلترة حسب الفني
        if ($request->has('technician_id') && $request->technician_id) {
            $query->where('seller_id', $request->technician_id);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        $regions = Region::where('is_active', true)->get();
        $technicians = User::whereHas('roles', function($q) {
            $q->where('name', 'Technician');
        })->get();
        
        return view('support.orders.index', compact('orders', 'regions', 'technicians'));
    }

    /**
     * عرض تفاصيل الطلب
     */
    public function show($id)
    {
        $order = Order::with([
            'service',
            'technician',
            'region',
            'service_city',
            'service_area',
            'service_country',
            'qualityFollowups'
        ])->findOrFail($id);
        
        $technicians = User::whereHas('roles', function($q) {
            $q->where('name', 'Technician');
        })->where('is_available', true)->get();
        
        $regions = Region::where('is_active', true)->get();
        
        return view('support.orders.show', compact('order', 'technicians', 'regions'));
    }

    /**
     * تحديث حالة الطلب
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3,4',
        ]);
        
        $order->status = $request->status;
        $order->save();
        
        // تحديث timestamps حسب الحالة
        if ($request->status == 2 && !$order->completed_at) {
            $order->completed_at = Carbon::now();
            $order->save();
        }
        
        return redirect()->back()->with('success', __('Order status updated successfully'));
    }

    /**
     * تعيين فني للطلب
     */
    public function assignTechnician(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'technician_id' => 'required|exists:users,id',
        ]);
        
        $technician = User::findOrFail($request->technician_id);
        
        // التحقق من أن المستخدم فني
        if (!$technician->hasRole('Technician')) {
            return redirect()->back()->with('error', __('Selected user is not a technician'));
        }
        
        $order->seller_id = $request->technician_id;
        $order->assigned_by = Auth::id();
        $order->assigned_at = Carbon::now();
        $order->save();
        
        // TODO: إرسال إشعار للفني
        
        return redirect()->back()->with('success', __('Technician assigned successfully'));
    }

    /**
     * تعيين فني تلقائياً
     */
    public function autoAssignTechnician(Request $request, $id)
    {
        $order = Order::with('region')->findOrFail($id);
        
        // البحث عن فني متاح في نفس المنطقة
        $technician = User::whereHas('roles', function($q) {
            $q->where('name', 'Technician');
        })
        ->where('is_available', true)
        ->where(function($query) use ($order) {
            if ($order->region_id) {
                $query->whereJsonContains('assigned_regions', $order->region_id);
            }
        })
        ->orderBy('completed_orders_count', 'asc')
        ->first();
        
        if ($technician) {
            $order->seller_id = $technician->id;
            $order->assigned_by = Auth::id();
            $order->assigned_at = Carbon::now();
            $order->save();
            
            return redirect()->back()->with('success', __('Technician assigned automatically'));
        }
        
        return redirect()->back()->with('error', __('No available technician found'));
    }

    /**
     * إضافة ملاحظة للطلب
     */
    public function addNote(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'note' => 'required|string|max:1000',
        ]);
        
        $currentNotes = $order->notes ?? '';
        $newNote = "\n[" . Carbon::now()->format('Y-m-d H:i') . "] " . Auth::user()->name . ": " . $request->note;
        $order->notes = $currentNotes . $newNote;
        $order->save();
        
        return redirect()->back()->with('success', __('Note added successfully'));
    }

    /**
     * تحديث المنطقة
     */
    public function updateRegion(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'region_id' => 'nullable|exists:regions,id',
        ]);
        
        $order->region_id = $request->region_id;
        $order->save();
        
        return redirect()->back()->with('success', __('Region updated successfully'));
    }

    /**
     * تصدير الطلبات بصيغة CSV
     */
    public function exportCSV(Request $request)
    {
        $query = Order::with(['service', 'technician', 'region']);
        
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $orders = $query->get();
        
        $filename = 'orders_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, [
                'ID',
                'Tracking Code',
                'Client Name',
                'Client Phone',
                'Service',
                'Technician',
                'Region',
                'Status',
                'Total',
                'Created At'
            ]);
            
            // Data
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->tracking_code ?? 'N/A',
                    $order->name,
                    $order->phone,
                    $order->service->title ?? 'N/A',
                    $order->technician->name ?? 'Not Assigned',
                    $order->region->name ?? 'N/A',
                    $this->getStatusText($order->status),
                    $order->total,
                    $order->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    private function getStatusText($status)
    {
        $statuses = [
            0 => 'Pending',
            1 => 'Active',
            2 => 'Completed',
            3 => 'Delivered',
            4 => 'Cancelled'
        ];
        
        return $statuses[$status] ?? 'Unknown';
    }

    /**
     * عرض قائمة العملاء
     */
    public function customers(Request $request)
    {
        $query = Order::select('email', 'phone')
            ->selectRaw('MAX(name) as name')
            ->selectRaw('MAX(address) as address')
            ->selectRaw('MAX(region_id) as region_id')
            ->selectRaw('COUNT(*) as orders_count')
            ->selectRaw('SUM(total) as total_spent')
            ->groupBy('email', 'phone');
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }
        
        $customers = $query->orderBy('orders_count', 'desc')->paginate(20);
        
        return view('support.customers.index', compact('customers'));
    }

    /**
     * عرض تفاصيل العميل
     */
    public function customerDetails($id)
    {
        // البحث عن العميل حسب البريد الإلكتروني أو الهاتف
        $customer = Order::where('email', $id)
            ->orWhere('phone', $id)
            ->first();
        
        if (!$customer) {
            abort(404);
        }
        
        $orders = Order::where('email', $customer->email)
            ->orWhere('phone', $customer->phone)
            ->with(['service', 'technician', 'region'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $stats = [
            'total_orders' => $orders->count(),
            'total_spent' => $orders->sum('total'),
            'completed_orders' => $orders->where('status', 2)->count(),
            'pending_orders' => $orders->where('status', 0)->count(),
        ];
        
        return view('support.customers.show', compact('customer', 'orders', 'stats'));
    }

    /**
     * عرض الملف الشخصي
     */
    public function profile()
    {
        $user = Auth::user();
        
        // سجل العمليات - الطلبات التي عالجها
        $activities = Order::where('assigned_by', $user->id)
            ->orWhere(function($query) use ($user) {
                $query->whereHas('qualityFollowups', function($q) use ($user) {
                    $q->where('created_by', $user->id);
                });
            })
            ->with(['service', 'technician', 'region'])
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        
        return view('support.profile', compact('user', 'activities'));
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

