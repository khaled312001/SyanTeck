<?php

if (!function_exists('generateTrackingCode')) {
    /**
     * إنشاء رمز تتبع فريد
     */
    function generateTrackingCode()
    {
        do {
            $code = 'TRK' . strtoupper(Str::random(8));
        } while (\App\Order::where('tracking_code', $code)->exists());
        
        return $code;
    }
}

if (!function_exists('generateWarrantyCode')) {
    /**
     * إنشاء رمز ضمان فريد
     */
    function generateWarrantyCode()
    {
        do {
            $code = 'WRT' . strtoupper(Str::random(8));
        } while (\App\Order::where('warranty_code', $code)->exists());
        
        return $code;
    }
}

if (!function_exists('calculateOrderPrice')) {
    /**
     * حساب سعر الطلب حسب قواعد التسعير
     */
    function calculateOrderPrice($serviceId, $regionId = null, $urgencyLevel = 'normal')
    {
        $service = \App\Service::find($serviceId);
        if (!$service) {
            return 0;
        }
        
        $basePrice = $service->price ?? 0;
        
        // البحث عن قاعدة تسعير مطابقة
        $pricingRule = \App\PricingRule::where('is_active', true)
            ->where(function($query) use ($serviceId, $regionId, $urgencyLevel) {
                $query->where(function($q) use ($serviceId) {
                    $q->where('type', 'service')
                      ->where('service_id', $serviceId);
                })
                ->orWhere(function($q) use ($regionId) {
                    if ($regionId) {
                        $q->where('type', 'region')
                          ->where('region_id', $regionId);
                    }
                })
                ->orWhere(function($q) use ($urgencyLevel) {
                    $q->where('type', 'urgency')
                      ->where('urgency_level', $urgencyLevel);
                });
            })
            ->orderBy('type', 'desc') // service أولاً، ثم region، ثم urgency
            ->first();
        
        if ($pricingRule) {
            $basePrice = $pricingRule->base_price;
            
            if ($pricingRule->additional_fee > 0) {
                if ($pricingRule->fee_type == 'percentage') {
                    $basePrice += ($basePrice * $pricingRule->additional_fee / 100);
                } else {
                    $basePrice += $pricingRule->additional_fee;
                }
            }
        }
        
        return round($basePrice, 2);
    }
}

if (!function_exists('autoAssignTechnician')) {
    /**
     * تعيين فني تلقائياً للطلب
     */
    function autoAssignTechnician($order)
    {
        $query = \App\User::whereHas('roles', function($q) {
            $q->where('name', 'Technician');
        })
        ->where('is_available', true)
        ->where('user_status', 1);
        
        // فلترة حسب المنطقة
        if ($order->region_id) {
            $query->where(function($q) use ($order) {
                $q->whereJsonContains('assigned_regions', $order->region_id)
                  ->orWhereNull('assigned_regions');
            });
        }
        
        // فلترة حسب التخصص
        if ($order->service && $order->service->category_id) {
            $query->where(function($q) use ($order) {
                $q->whereJsonContains('specializations', $order->service->category_id)
                  ->orWhereNull('specializations');
            });
        }
        
        // ترتيب حسب عدد الطلبات المكتملة (الأقل أولاً)
        $technician = $query->orderBy('completed_orders_count', 'asc')
            ->orderBy('rating', 'desc')
            ->first();
        
        return $technician;
    }
}

if (!function_exists('getOrderStatusText')) {
    /**
     * الحصول على نص حالة الطلب
     */
    function getOrderStatusText($status)
    {
        $statuses = [
            0 => __('Pending'),
            1 => __('Active'),
            2 => __('Completed'),
            3 => __('Delivered'),
            4 => __('Cancelled')
        ];
        
        return $statuses[$status] ?? __('Unknown');
    }
}

if (!function_exists('getOrderStatusBadge')) {
    /**
     * الحصول على badge HTML لحالة الطلب
     */
    function getOrderStatusBadge($status)
    {
        $badges = [
            0 => '<span class="badge badge-warning">' . __('Pending') . '</span>',
            1 => '<span class="badge badge-info">' . __('Active') . '</span>',
            2 => '<span class="badge badge-success">' . __('Completed') . '</span>',
            3 => '<span class="badge badge-primary">' . __('Delivered') . '</span>',
            4 => '<span class="badge badge-danger">' . __('Cancelled') . '</span>',
        ];
        
        return $badges[$status] ?? '<span class="badge badge-secondary">' . __('Unknown') . '</span>';
    }
}

if (!function_exists('notifySupportNewOrder')) {
    /**
     * إرسال إشعار للدعم عند إنشاء طلب جديد
     */
    function notifySupportNewOrder($order)
    {
        // إرسال إشعار لجميع أعضاء الدعم
        $supportUsers = \App\User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Support Agent', 'Admin', 'Super Admin']);
        })->get();
        
        foreach ($supportUsers as $user) {
            $user->notify(new \App\Notifications\OrderNotification([
                'order_id' => $order->id,
                'message' => __('New maintenance order received. Tracking Code: :code', ['code' => $order->tracking_code]),
                'type' => 'new_order',
            ]));
        }
        
        // إرسال بريد إلكتروني للإدارة
        try {
            $adminEmail = get_static_option('site_global_email') ?? 'admin@syanteck.com';
            $subject = __('New Maintenance Order - Tracking Code: :code', ['code' => $order->tracking_code]);
            $message = __('A new maintenance order has been received.<br><br>Tracking Code: <strong>:code</strong><br>Service: :service<br>Customer: :name<br>Phone: :phone<br>Address: :address<br><br>Please assign a technician as soon as possible.', [
                'code' => $order->tracking_code,
                'service' => optional($order->service)->title,
                'name' => $order->name,
                'phone' => $order->phone,
                'address' => $order->address,
            ]);
            
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\BasicMail([
                'subject' => $subject,
                'message' => $message,
            ]));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error sending admin email: ' . $e->getMessage());
        }
    }
}

