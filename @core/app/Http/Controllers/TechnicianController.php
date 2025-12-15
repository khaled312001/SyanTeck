<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TechnicianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * لوحة تحكم الفني
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total' => Order::where('seller_id', $user->id)->count(),
            'pending' => Order::where('seller_id', $user->id)->where('status', 0)->count(),
            'active' => Order::where('seller_id', $user->id)->where('status', 1)->count(),
            'completed' => Order::where('seller_id', $user->id)->where('status', 2)->count(),
        ];
        
        $recentOrders = Order::where('seller_id', $user->id)
            ->with(['service', 'region'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('technician.dashboard', compact('stats', 'recentOrders'));
    }

    /**
     * عرض الطلبات المخصصة للفني
     */
    public function orders(Request $request)
    {
        $user = Auth::user();
        
        $query = Order::where('seller_id', $user->id)
            ->with(['service', 'region']);
        
        // فلترة حسب الحالة
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('technician.orders.index', compact('orders'));
    }

    /**
     * قبول الطلب
     */
    public function acceptOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        
        // التحقق من أن الطلب مخصص لهذا الفني
        if ($order->seller_id != $user->id) {
            return redirect()->back()->with('error', __('Unauthorized access'));
        }
        
        // التحقق من أن الطلب في حالة pending
        if ($order->status != 0) {
            return redirect()->back()->with('error', __('Order cannot be accepted in current status'));
        }
        
        $order->status = 1; // Active
        $order->accepted_at = Carbon::now();
        $order->technician_order_status = 'accepted';
        
        // حفظ موقع GPS الأولي إذا تم إرساله
        if ($request->has('latitude') && $request->has('longitude')) {
            $order->technician_latitude = $request->latitude;
            $order->technician_longitude = $request->longitude;
            $order->technician_last_location_update = Carbon::now();
        }
        
        $order->save();
        
        // إرسال إشعارات
        $this->sendStatusUpdateNotifications($order, 'accepted');
        
        return redirect()->back()->with('success', __('Order accepted successfully'));
    }

    /**
     * رفض الطلب
     */
    public function rejectOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        
        // التحقق من أن الطلب مخصص لهذا الفني
        if ($order->seller_id != $user->id) {
            return redirect()->back()->with('error', __('Unauthorized access'));
        }
        
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);
        
        // تحديث حالة الطلب
        $order->technician_order_status = 'rejected';
        
        // إلغاء تعيين الفني
        $order->seller_id = null;
        $order->assigned_at = null;
        $order->accepted_at = null;
        $order->status = 0; // Back to pending
        
        // حفظ سبب الرفض في الملاحظات
        if ($request->has('rejection_reason')) {
            $rejectionNote = "\n[رفض الفني] " . Carbon::now()->format('Y-m-d H:i:s') . ": " . $request->rejection_reason;
            $order->notes = ($order->notes ?? '') . $rejectionNote;
        }
        
        $order->save();
        
        // إرسال إشعارات
        $this->sendStatusUpdateNotifications($order, 'rejected');
        
        return redirect()->back()->with('success', __('Order rejected. Support will reassign it.'));
    }

    /**
     * تحديث حالة الطلب
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        
        // التحقق من أن الطلب مخصص لهذا الفني
        if ($order->seller_id != $user->id) {
            return redirect()->back()->with('error', __('Unauthorized access'));
        }
        
        $request->validate([
            'status' => 'required|string|in:en_route,arrived,started,completed',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);
        
        $status = $request->status;
        $timestampField = $status . '_at';
        
        // تحديث timestamp المناسب
        if (!$order->$timestampField) {
            $order->$timestampField = Carbon::now();
        }
        
        // تحديث حالة الطلب من الفني
        $order->technician_order_status = $status;
        
        // تحديث موقع GPS إذا تم إرساله
        if ($request->has('latitude') && $request->has('longitude')) {
            $order->technician_latitude = $request->latitude;
            $order->technician_longitude = $request->longitude;
            $order->technician_last_location_update = Carbon::now();
        }
        
        // تحديث حالة الطلب حسب الحالة
        if ($status == 'completed') {
            $order->status = 2; // Completed
            $order->completed_at = Carbon::now();
            
            // تحديث إحصائيات الفني (إذا كان الحقل موجوداً)
            if (Schema::hasColumn('users', 'completed_orders_count')) {
                $user->completed_orders_count = ($user->completed_orders_count ?? 0) + 1;
                $user->save();
            }
        } elseif ($status == 'en_route') {
            $order->status = 1; // Active
        }
        
        $order->save();
        
        // إرسال إشعارات للعميل والدعم والأدمن
        $this->sendStatusUpdateNotifications($order, $status);
        
        return redirect()->back()->with('success', __('Order status updated successfully'));
    }
    
    /**
     * تحديث موقع GPS للفني
     */
    public function updateLocation(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        
        // التحقق من أن الطلب مخصص لهذا الفني
        if ($order->seller_id != $user->id) {
            return response()->json(['error' => __('Unauthorized access')], 403);
        }
        
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
        
        $order->technician_latitude = $request->latitude;
        $order->technician_longitude = $request->longitude;
        $order->technician_last_location_update = Carbon::now();
        $order->save();
        
        // إرسال إشعارات للمتابعين
        $this->broadcastLocationUpdate($order);
        
        return response()->json([
            'success' => true,
            'message' => __('Location updated successfully'),
            'timestamp' => $order->technician_last_location_update->toIso8601String()
        ]);
    }
    
    /**
     * إرسال إشعارات تحديث الحالة
     */
    private function sendStatusUpdateNotifications($order, $status)
    {
        // TODO: إرسال إشعارات للعميل والدعم والأدمن
        // يمكن استخدام Laravel Notifications أو Events
    }
    
    /**
     * بث تحديث الموقع
     */
    private function broadcastLocationUpdate($order)
    {
        // TODO: بث تحديث الموقع للمتابعين (WebSocket أو Polling)
    }

    /**
     * عرض تفاصيل الطلب
     */
    public function orderDetails($id)
    {
        $order = Order::with([
            'service',
            'region',
            'service_city',
            'service_area',
            'service_country'
        ])->findOrFail($id);
        
        $user = Auth::user();
        
        // التحقق من أن الطلب مخصص لهذا الفني
        if ($order->seller_id != $user->id) {
            abort(403, 'Unauthorized access');
        }
        
        return view('technician.orders.show', compact('order'));
    }

    /**
     * الملف الشخصي للفني
     */
    public function profile()
    {
        $user = Auth::user();
        
        // سجل العمليات - الطلبات المخصصة للفني
        $activities = Order::where('seller_id', $user->id)
            ->with(['service', 'region'])
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        
        return view('technician.profile', compact('user', 'activities'));
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
            'is_available' => 'boolean',
        ]);
        
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->is_available = $request->has('is_available') ? true : false;
        $user->save();
        
        return redirect()->back()->with('success', __('Profile updated successfully'));
    }

    /**
     * رفع صور العطل
     */
    public function uploadIssueImages(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        
        // التحقق من أن الطلب مخصص لهذا الفني
        if ($order->seller_id != $user->id) {
            return redirect()->back()->with('error', __('Unauthorized access'));
        }
        
        $request->validate([
            'issue_images.*' => 'required|file|mimes:jpeg,jpg,png,gif,bmp,webp,svg,mp4,avi,mov,wmv,flv,webm,3gp,mkv,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:512000', // 500MB max لكل ملف
        ], [
            'issue_images.*.required' => __('Please select at least one file'),
            'issue_images.*.file' => __('The uploaded file is invalid'),
            'issue_images.*.mimes' => __('The file must be an image, video, or document'),
            'issue_images.*.max' => __('Each file must not exceed 500MB'),
        ]);
        
        $uploadedFiles = [];
        $folderPath = 'assets/uploads/order-issues/';
        
        // إنشاء المجلد إذا لم يكن موجوداً
        if (!file_exists(public_path($folderPath))) {
            mkdir(public_path($folderPath), 0755, true);
        }
        
        if ($request->hasFile('issue_images')) {
            foreach ($request->file('issue_images') as $file) {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = 'issue_' . $order->id . '_' . time() . '_' . uniqid() . '_' . Str::slug($originalName) . '.' . $extension;
                $file->move(public_path($folderPath), $fileName);
                $uploadedFiles[] = $folderPath . $fileName;
            }
        }
        
        // دمج الملفات الجديدة مع الملفات الموجودة
        $existingFiles = $order->issue_images ?? [];
        $allFiles = array_merge($existingFiles, $uploadedFiles);
        
        $order->issue_images = $allFiles;
        
        // حفظ الملف الأول في issue_image للتوافق مع النظام القديم (إذا كان صورة)
        if (empty($order->issue_image) && !empty($uploadedFiles)) {
            $firstFile = $uploadedFiles[0];
            $firstFileExtension = strtolower(pathinfo($firstFile, PATHINFO_EXTENSION));
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
            if (in_array($firstFileExtension, $imageExtensions)) {
                $order->issue_image = $firstFile;
            }
        }
        
        $order->save();
        
        $fileCount = count($uploadedFiles);
        $message = $fileCount > 1 
            ? __('Files uploaded successfully') . ' (' . $fileCount . ' ' . __('files') . ')' 
            : __('File uploaded successfully');
        
        return redirect()->back()->with('success', $message);
    }

    /**
     * حذف صورة عطل
     */
    public function deleteIssueImage(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        
        // التحقق من أن الطلب مخصص لهذا الفني
        if ($order->seller_id != $user->id) {
            return response()->json(['error' => __('Unauthorized access')], 403);
        }
        
        $request->validate([
            'image_path' => 'required|string',
        ]);
        
        $imagePath = $request->image_path;
        $images = $order->issue_images ?? [];
        
        // إزالة الصورة من المصفوفة
        $images = array_filter($images, function($img) use ($imagePath) {
            return $img !== $imagePath;
        });
        
        // حذف الملف من السيرفر
        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
        
        $order->issue_images = array_values($images); // إعادة ترقيم المصفوفة
        
        // تحديث issue_image إذا كانت الصورة المحذوفة هي الأولى
        if ($order->issue_image === $imagePath) {
            $order->issue_image = !empty($images) ? reset($images) : null;
        }
        
        $order->save();
        
        return response()->json(['success' => true, 'message' => __('Image deleted successfully')]);
    }
}

