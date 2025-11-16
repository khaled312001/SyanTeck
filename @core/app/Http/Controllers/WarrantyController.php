<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class WarrantyController extends Controller
{
    /**
     * إنشاء شهادة ضمان إلكترونية للطلب
     */
    public function generateWarranty($orderId)
    {
        $order = Order::with([
            'service',
            'client',
            'technician',
            'service_city',
            'service_area',
            'service_country',
            'region'
        ])->findOrFail($orderId);
        
        // التحقق من أن الطلب مكتمل
        if ($order->status < 2) {
            return redirect()->back()->with('error', __('Order must be completed to generate warranty'));
        }
        
        // التحقق من الصلاحيات
        $user = Auth::guard('admin')->user() ?? Auth::user();
        $canGenerate = false;
        
        // Admin guard
        if (Auth::guard('admin')->check()) {
            $canGenerate = true;
        }
        // User guard
        elseif (Auth::check()) {
            if ($user->hasRole('Admin') || $user->hasRole('Support')) {
                $canGenerate = true;
            } elseif ($user->hasRole('Technician') && $order->seller_id == $user->id) {
                $canGenerate = true;
            }
        }
        
        if (!$canGenerate) {
            abort(403, 'Unauthorized');
        }
        
        // إنشاء كود ضمان إذا لم يكن موجوداً
        if (empty($order->warranty_code)) {
            $order->warranty_code = 'WAR-' . strtoupper(uniqid());
            $order->warranty_days = $order->warranty_days ?? 30;
            $order->has_warranty = true;
            $order->warranty_issued_at = Carbon::now();
            if (Auth::guard('admin')->check()) {
                $order->warranty_issued_by = Auth::guard('admin')->id();
            } else {
                $order->warranty_issued_by = $user->id;
            }
            $order->save();
        }
        
        // إنشاء PDF لشهادة الضمان
        $pdf = PDF::loadView('warranties.warranty-certificate', compact('order'));
        
        // حفظ ملف PDF
        $fileName = 'warranty_' . $order->warranty_code . '_' . time() . '.pdf';
        $folderPath = 'assets/uploads/warranties/';
        
        if (!file_exists(public_path($folderPath))) {
            mkdir(public_path($folderPath), 0755, true);
        }
        
        $pdfPath = $folderPath . $fileName;
        $pdf->save(public_path($pdfPath));
        
        // حفظ مسار PDF في قاعدة البيانات
        $order->warranty_pdf = $pdfPath;
        $order->save();
        
        return $pdf->download($fileName);
    }
    
    /**
     * عرض شهادة الضمان
     */
    public function viewWarranty($orderId)
    {
        $order = Order::with([
            'service',
            'client',
            'technician',
            'service_city',
            'service_area',
            'service_country',
            'region',
            'warrantyIssuedBy'
        ])->findOrFail($orderId);
        
        // التحقق من الصلاحيات
        $user = Auth::guard('admin')->user() ?? Auth::user();
        $canView = false;
        
        if (Auth::guard('admin')->check()) {
            $canView = true;
        } elseif (Auth::check()) {
            if ($user->hasRole('Admin') || $user->hasRole('Support')) {
                $canView = true;
            } elseif ($user->hasRole('Technician') && $order->seller_id == $user->id) {
                $canView = true;
            }
        }
        
        if (!$canView) {
            abort(403, 'Unauthorized');
        }
        
        if (!$order->hasWarranty()) {
            return redirect()->back()->with('error', __('Warranty certificate not found'));
        }
        
        return view('warranties.view', compact('order'));
    }
    
    /**
     * تحميل شهادة الضمان
     */
    public function downloadWarranty($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if (empty($order->warranty_pdf) || !file_exists(public_path($order->warranty_pdf))) {
            // إعادة إنشاء شهادة الضمان إذا لم تكن موجودة
            return $this->generateWarranty($orderId);
        }
        
        return response()->download(public_path($order->warranty_pdf));
    }
}

