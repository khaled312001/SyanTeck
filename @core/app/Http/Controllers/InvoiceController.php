<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class InvoiceController extends Controller
{
    /**
     * إنشاء فاتورة إلكترونية للطلب
     */
    public function generateInvoice($orderId)
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
        
        // إنشاء رقم فاتورة إذا لم يكن موجوداً
        if (empty($order->invoice_number)) {
            $order->invoice_number = 'INV-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
            $order->invoice_date = Carbon::now();
            if (Auth::guard('admin')->check()) {
                $order->invoice_issued_by = Auth::guard('admin')->id();
            } else {
                $order->invoice_issued_by = $user->id;
            }
            $order->save();
        }
        
        // إنشاء PDF للفاتورة
        $pdf = PDF::loadView('invoices.order-invoice', compact('order'));
        
        // حفظ ملف PDF
        $fileName = 'invoice_' . $order->invoice_number . '_' . time() . '.pdf';
        $folderPath = 'assets/uploads/invoices/';
        
        if (!file_exists(public_path($folderPath))) {
            mkdir(public_path($folderPath), 0755, true);
        }
        
        $pdfPath = $folderPath . $fileName;
        $pdf->save(public_path($pdfPath));
        
        // حفظ مسار PDF في قاعدة البيانات
        $order->invoice_pdf = $pdfPath;
        $order->save();
        
        return $pdf->download($fileName);
    }
    
    /**
     * عرض الفاتورة
     */
    public function viewInvoice($orderId)
    {
        $order = Order::with([
            'service',
            'client',
            'technician',
            'service_city',
            'service_area',
            'service_country',
            'region',
            'invoiceIssuedBy'
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
        
        if (!$order->hasInvoice()) {
            return redirect()->back()->with('error', __('Invoice not found'));
        }
        
        // تحديد الـ view حسب guard
        $viewName = Auth::guard('admin')->check() ? 'invoices.view' : 'invoices.view';
        
        return view($viewName, compact('order'));
    }
    
    /**
     * تحميل الفاتورة
     */
    public function downloadInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if (empty($order->invoice_pdf) || !file_exists(public_path($order->invoice_pdf))) {
            // إعادة إنشاء الفاتورة إذا لم تكن موجودة
            return $this->generateInvoice($orderId);
        }
        
        return response()->download(public_path($order->invoice_pdf));
    }
}

