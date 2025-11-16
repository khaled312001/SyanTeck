<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Modules\JobPost\Entities\BuyerJob;
use App\Admin;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'invoice',
        'service_id',
        'seller_id', // سيستخدم كـ technician_id
        'buyer_id', // سيستخدم كـ client_id
        'name',
        'email',
        'phone',
        'post_code',
        'address',
        'city',
        'area',
        'country',
        'date',
        'schedule',
        'package_fee',
        'extra_service',
        'sub_total',
        'tax',
        'total',
        'coupon_code',
        'coupon_type',
        'coupon_amount',
        'commission_type',
        'commission_charge',
        'commission_amount',
        'payment_gateway',
        'payment_status',
        'status',
        'is_order_online',
        'order_note',
        'order_complete_request',
        'cancel_order_money_return',
        'manual_payment_image',
        'order_from_job',
        'job_post_id',
        // حقول جديدة للصيانة
        'tracking_code',
        'warranty_code',
        'warranty_days',
        'has_warranty',
        'assigned_by',
        'region_id',
        'notes',
        'urgency_level',
        'issue_image',
        'issue_images',
        'assigned_at',
        'accepted_at',
        'en_route_at',
        'arrived_at',
        'started_at',
        'completed_at',
        // حقول الفاتورة الإلكترونية
        'invoice_pdf',
        'invoice_number',
        'invoice_date',
        'invoice_issued_by',
        // حقول شهادة الضمان
        'warranty_pdf',
        'warranty_issued_at',
        'warranty_issued_by',
        // حقول تقرير الفني
        'technician_report',
        'technician_images',
        'technician_videos',
        'technician_report_submitted_at',
        // حقول تسعير الإدمن/فريق الدعم
        'admin_pricing',
        'admin_pricing_notes',
        'admin_pricing_at',
        'admin_pricing_by',
    ];
    
    protected $casts = [
        'status' => 'integer',
        'is_order_online' => 'integer',
        'has_warranty' => 'boolean',
        'assigned_at' => 'datetime',
        'accepted_at' => 'datetime',
        'en_route_at' => 'datetime',
        'arrived_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'invoice_date' => 'date',
        'warranty_issued_at' => 'datetime',
        'issue_images' => 'array',
        'technician_images' => 'array',
        'technician_videos' => 'array',
        'technician_report_submitted_at' => 'datetime',
        'admin_pricing_at' => 'datetime',
    ];

    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function seller(){
        return $this->belongsTo(User::class,'seller_id','id');
    }
    
    // Alias للتوافق مع نظام الصيانة
    public function technician(){
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    
    // Alias للتوافق مع نظام الصيانة
    public function client(){
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    
    public function assignedBy(){
        return $this->belongsTo(User::class,'assigned_by','id');
    }
    
    public function region(){
        return $this->belongsTo(Region::class,'region_id','id');
    }
    
    public function qualityFollowups(){
        return $this->hasMany(QualityFollowup::class,'order_id','id');
    }

    public function service_city(){
        return $this->belongsTo(ServiceCity::class,'city','id');
    }

    public function service_area(){
        return $this->belongsTo(ServiceArea::class,'area','id');
    }

    public function service_country(){
        return $this->belongsTo(Country::class,'country','id');
    }

    public function orderIncludes(){
        return $this->hasmany(OrderInclude::class,'order_id','id');
    }

    public function orderAdditionals(){
        return $this->hasmany(OrderAdditional::class,'order_id','id');
    }
    public function extraSevices(){
        return $this->hasmany(ExtraService::class,'order_id','id');
    }
    
     public function online_order_ticket(){
        return $this->hasOne(SupportTicket::class,'order_id','id');
    }

    public function job(){
        return $this->belongsTo(BuyerJob::class,'job_post_id','id');
    }

    public function completedeclinehistory(){
        return $this->hasmany(OrderCompleteDecline::class,'order_id','id');
    }
    
    public function invoiceIssuedBy(){
        // يمكن أن يكون Admin أو User
        if ($this->invoice_issued_by) {
            // محاولة البحث في Admin أولاً
            $admin = Admin::find($this->invoice_issued_by);
            if ($admin) {
                return $admin;
            }
            // إذا لم يكن Admin، ابحث في User
            return User::find($this->invoice_issued_by);
        }
        return null;
    }
    
    public function warrantyIssuedBy(){
        // يمكن أن يكون Admin أو User
        if ($this->warranty_issued_by) {
            // محاولة البحث في Admin أولاً
            $admin = Admin::find($this->warranty_issued_by);
            if ($admin) {
                return $admin;
            }
            // إذا لم يكن Admin، ابحث في User
            return User::find($this->warranty_issued_by);
        }
        return null;
    }
    
    public function adminPricingBy(){
        return $this->belongsTo(Admin::class,'admin_pricing_by','id');
    }
    
    /**
     * التحقق من وجود فاتورة
     */
    public function hasInvoice(){
        return !empty($this->invoice_pdf) && !empty($this->invoice_number);
    }
    
    /**
     * التحقق من وجود شهادة ضمان
     */
    public function hasWarranty(){
        return !empty($this->warranty_pdf) && !empty($this->warranty_code);
    }
    
    /**
     * الحصول على صور العطل
     */
    public function getIssueImagesAttribute($value){
        if (empty($value)) {
            return [];
        }
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }
    
    /**
     * حفظ صور العطل
     */
    public function setIssueImagesAttribute($value){
        if (is_array($value)) {
            $this->attributes['issue_images'] = json_encode($value);
        } else {
            $this->attributes['issue_images'] = $value;
        }
    }
}
