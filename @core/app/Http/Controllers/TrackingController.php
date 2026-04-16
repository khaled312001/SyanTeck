<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * عرض صفحة تتبع الطلب - عامة
     * يعرض فقط البيانات الأساسية دون معلومات شخصية حساسة
     */
    public function show($code)
    {
        $order = Order::where('tracking_code', $code)
            ->with(['service:id,title,image', 'region:id,name'])
            ->firstOrFail();

        // إعداد بيانات محدودة للعرض العام (بدون معلومات شخصية)
        $trackingData = [
            'tracking_code' => $order->tracking_code,
            'service_name' => $order->service->title ?? __('N/A'),
            'status' => $order->status,
            'status_label' => $order->status_label,
            'region' => $order->region->name ?? __('N/A'),
            'created_at' => $order->created_at,
            'urgency_level' => $order->urgency_level,
            // حالة الفني (بدون بيانات شخصية)
            'technician_assigned' => !empty($order->seller_id),
            'technician_order_status' => $order->technician_order_status,
            // Timestamps
            'assigned_at' => $order->assigned_at,
            'accepted_at' => $order->accepted_at,
            'en_route_at' => $order->en_route_at,
            'arrived_at' => $order->arrived_at,
            'started_at' => $order->started_at,
            'completed_at' => $order->completed_at,
        ];

        return view('tracking.show', compact('trackingData', 'order'));
    }
}

