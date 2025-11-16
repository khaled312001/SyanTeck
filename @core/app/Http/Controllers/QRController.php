<?php

namespace App\Http\Controllers;

use App\Order;
use App\Service;
use App\Category;
use App\Region;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class QRController extends Controller
{
    /**
     * عرض صفحة طلب QR
     */
    public function index()
    {
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();
        $services = Service::where(['status' => 1, 'is_service_on' => 1])
            ->with('category')
            ->orderBy('title', 'asc')
            ->get();
        $regions = Region::where('is_active', true)->orderBy('name', 'asc')->get();
        
        return view('qr.index', compact('categories', 'services', 'regions'));
    }

    /**
     * حفظ طلب QR (بدون تسجيل دخول)
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'region_id' => 'nullable|exists:regions,id',
            'urgency_level' => 'required|in:normal,urgent,emergency',
            'order_note' => 'nullable|string|max:1000',
            'preferred_date' => 'nullable|date|after_or_equal:today',
            'issue_image' => 'nullable|file|max:512000', // Max 500MB (512000 KB)
        ]);
        
        $service = Service::findOrFail($request->service_id);
        
        // إنشاء رمز تتبع فريد
        $trackingCode = 'TRK' . strtoupper(Str::random(8));
        while (Order::where('tracking_code', $trackingCode)->exists()) {
            $trackingCode = 'TRK' . strtoupper(Str::random(8));
        }
        
        // السعر سيتم تحديده من قبل الفني بعد المعاينة
        $basePrice = 0;
        $urgencyFee = 0;
        $subTotal = 0;
        $tax = 0;
        $total = 0;
        
        // معالجة رفع ملف العطل (صورة، فيديو، أو أي ملف)
        $issueImageName = null;
        if ($request->hasFile('issue_image')) {
            $file = $request->file('issue_image');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'issue_' . time() . '_' . uniqid() . '.' . $extension;
            $filePath = 'assets/uploads/issue-images/';
            
            // إنشاء المجلد إذا لم يكن موجوداً
            if (!file_exists(public_path($filePath))) {
                mkdir(public_path($filePath), 0755, true);
            }
            
            $file->move(public_path($filePath), $fileName);
            $issueImageName = $fileName;
        }
        
        $order = Order::create([
            'service_id' => $request->service_id,
            'seller_id' => null, // سيتم تعيينه من قبل الدعم
            'buyer_id' => null, // بدون تسجيل دخول
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'region_id' => $request->region_id,
            'urgency_level' => $request->urgency_level,
            'order_note' => $request->order_note,
            'tracking_code' => $trackingCode,
            'package_fee' => $basePrice,
            'extra_service' => $urgencyFee, // استخدام extra_service لحفظ رسوم الاستعجال
            'sub_total' => $subTotal,
            'tax' => $tax,
            'total' => $total,
            'status' => 0, // Pending - في انتظار التعيين
            'payment_status' => 'pending',
            'date' => $request->preferred_date ?? now()->format('Y-m-d'),
            'issue_image' => $issueImageName,
        ]);
        
        // إرسال إشعار للدعم والإدارة
        try {
            // استخدام الدالة المساعدة
            if (function_exists('notifySupportNewOrder')) {
                notifySupportNewOrder($order);
            } else {
                // إرسال إشعار لجميع أعضاء الدعم والإدارة
                $supportUsers = \App\User::whereHas('roles', function($q) {
                    $q->whereIn('name', ['Support Agent', 'Admin', 'Super Admin']);
                })->get();
                
                foreach ($supportUsers as $user) {
                    $user->notify(new \App\Notifications\OrderNotification(
                        $order->id,
                        $order->service_id,
                        $order->seller_id ?? 0,
                        $order->buyer_id ?? 0,
                        __('New maintenance order received. Tracking Code: :code', ['code' => $order->tracking_code])
                    ));
                }
                
                // إرسال بريد إلكتروني للإدارة
                $adminEmail = get_static_option('site_global_email') ?? 'admin@syanteck.com';
                $subject = __('New Maintenance Order - Tracking Code: :code', ['code' => $order->tracking_code]);
                $imageHtml = '';
                if ($order->issue_image) {
                    $imageUrl = asset('assets/uploads/issue-images/' . $order->issue_image);
                    $imageHtml = '<br><br><strong>' . __('Issue Image') . ':</strong><br><img src="' . $imageUrl . '" alt="Issue Image" style="max-width: 500px; border-radius: 10px; margin-top: 10px;"><br>';
                }
                $message = __('A new maintenance order has been received.<br><br>Tracking Code: <strong>:code</strong><br>Service: :service<br>Customer: :name<br>Phone: :phone<br>Email: :email<br>Address: :address<br>Urgency: :urgency<br>Price: :price<br>Notes: :notes:image<br><br>Please assign a technician as soon as possible. The technician will determine the price after inspection.', [
                    'code' => $order->tracking_code,
                    'service' => $service->title,
                    'name' => $order->name,
                    'phone' => $order->phone,
                    'email' => $order->email,
                    'address' => $order->address,
                    'urgency' => ucfirst($order->urgency_level),
                    'price' => __('To be determined by technician'),
                    'notes' => $order->order_note ?? __('No notes'),
                    'image' => $imageHtml,
                ]);
                
                Mail::to($adminEmail)->send(new BasicMail([
                    'subject' => $subject,
                    'message' => $message,
                ]));
            }
        } catch (\Exception $e) {
            Log::error('Error sending support notification: ' . $e->getMessage());
        }
        
        // إرسال بريد إلكتروني للعميل
        try {
            $emailSubject = __('Order Confirmation - Tracking Code: :code', ['code' => $trackingCode]);
            $emailMessage = __('Dear :name,<br><br>Your maintenance service request has been received successfully.<br><br>Tracking Code: <strong>:code</strong><br>Service: :service<br>Price: :price<br><br>Our support team will contact you shortly. The technician will inspect the issue and determine the final price before starting the work.<br><br>Thank you for choosing SyanTeck.', [
                'name' => $request->name,
                'code' => $trackingCode,
                'service' => $service->title,
                'price' => __('To be determined by technician after inspection'),
            ]);
            
            $mailData = [
                'subject' => $emailSubject,
                'message' => $emailMessage,
            ];
            
            Mail::to($request->email)->send(new BasicMail($mailData));
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
        
        return redirect()->route('track', $trackingCode)
            ->with('success', __('Order created successfully. Your tracking code is: :code', ['code' => $trackingCode]));
    }
}

