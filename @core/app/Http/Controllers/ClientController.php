<?php

namespace App\Http\Controllers;

use App\Order;
use App\Service;
use App\Category;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * لوحة تحكم العميل
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total' => Order::where('buyer_id', $user->id)->count(),
            'pending' => Order::where('buyer_id', $user->id)->where('status', 0)->count(),
            'active' => Order::where('buyer_id', $user->id)->where('status', 1)->count(),
            'completed' => Order::where('buyer_id', $user->id)->where('status', 2)->count(),
        ];
        
        $recentOrders = Order::where('buyer_id', $user->id)
            ->with(['service', 'technician', 'region'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('client.dashboard', compact('stats', 'recentOrders'));
    }

    /**
     * عرض طلبات العميل
     */
    public function orders(Request $request)
    {
        $user = Auth::user();
        
        $query = Order::where('buyer_id', $user->id)
            ->with(['service', 'technician', 'region']);
        
        // فلترة حسب الحالة
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('client.orders.index', compact('orders'));
    }

    /**
     * عرض نموذج إنشاء طلب جديد - نفس صفحة QR
     */
    public function createRequest()
    {
        // إعادة توجيه إلى صفحة QR
        return redirect()->route('qr.index');
    }

    /**
     * حفظ طلب جديد
     */
    public function storeRequest(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'region_id' => 'nullable|exists:regions,id',
            'urgency_level' => 'required|in:normal,urgent,emergency',
            'order_note' => 'nullable|string|max:1000',
        ]);
        
        $service = Service::findOrFail($request->service_id);
        
        // إنشاء رمز تتبع فريد
        $trackingCode = 'TRK' . strtoupper(Str::random(8));
        while (Order::where('tracking_code', $trackingCode)->exists()) {
            $trackingCode = 'TRK' . strtoupper(Str::random(8));
        }
        
        // حساب السعر
        $basePrice = $service->price ?? 0;
        $total = $basePrice;
        
        // TODO: تطبيق قواعد التسعير
        
        $order = Order::create([
            'service_id' => $request->service_id,
            'buyer_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'region_id' => $request->region_id,
            'urgency_level' => $request->urgency_level,
            'order_note' => $request->order_note,
            'tracking_code' => $trackingCode,
            'package_fee' => $basePrice,
            'sub_total' => $basePrice,
            'total' => $total,
            'status' => 0, // Pending
            'payment_status' => 'pending',
        ]);
        
        // TODO: إرسال إشعار للدعم
        
        return redirect()->route('client.orders')->with('success', __('Order created successfully. Tracking code: :code', ['code' => $trackingCode]));
    }

    /**
     * تتبع الطلب
     */
    public function trackOrder($code)
    {
        $order = Order::where('tracking_code', $code)
            ->with(['service', 'technician', 'region', 'service_city', 'service_area'])
            ->firstOrFail();
        
        $user = Auth::user();
        
        // التحقق من أن الطلب يخص هذا العميل
        if ($order->buyer_id != $user->id) {
            abort(403, 'Unauthorized access');
        }
        
        return view('client.track', compact('order'));
    }

    /**
     * عرض الفاتورة
     */
    public function invoice($id)
    {
        $order = Order::with(['service', 'technician', 'region'])
            ->findOrFail($id);
        
        $user = Auth::user();
        
        // التحقق من أن الطلب يخص هذا العميل
        if ($order->buyer_id != $user->id) {
            abort(403, 'Unauthorized access');
        }
        
        return view('client.invoice', compact('order'));
    }

    /**
     * عرض الضمان
     */
    public function warranty($id)
    {
        $order = Order::with(['service', 'technician'])
            ->findOrFail($id);
        
        $user = Auth::user();
        
        // التحقق من أن الطلب يخص هذا العميل
        if ($order->buyer_id != $user->id) {
            abort(403, 'Unauthorized access');
        }
        
        // التحقق من أن الطلب مكتمل
        if ($order->status != 2) {
            return redirect()->back()->with('error', __('Order must be completed to view warranty'));
        }
        
        // إنشاء رمز ضمان إذا لم يكن موجوداً
        if (!$order->warranty_code) {
            $warrantyCode = 'WRT' . strtoupper(Str::random(8));
            while (Order::where('warranty_code', $warrantyCode)->exists()) {
                $warrantyCode = 'WRT' . strtoupper(Str::random(8));
            }
            
            $order->warranty_code = $warrantyCode;
            $order->warranty_days = 30; // افتراضي
            $order->has_warranty = true;
            $order->save();
        }
        
        return view('client.warranty', compact('order'));
    }

    /**
     * عرض الملف الشخصي
     */
    public function profile()
    {
        $user = Auth::user();
        
        // سجل العمليات - طلبات العميل
        $activities = Order::where('buyer_id', $user->id)
            ->with(['service', 'technician', 'region'])
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        
        return view('client.profile', compact('user', 'activities'));
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

