<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * عرض صفحة تتبع الطلب
     */
    public function show($code)
    {
        $order = Order::where('tracking_code', $code)
            ->with(['service', 'technician', 'region', 'service_city', 'service_area'])
            ->firstOrFail();
        
        return view('tracking.show', compact('order'));
    }
}

