<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'category_id',
        'service_id',
        'region_id',
        'urgency_level',
        'base_price',
        'additional_fee',
        'fee_type',
        'is_active'
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'additional_fee' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

