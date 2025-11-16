<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'city_id',
        'area_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function city()
    {
        return $this->belongsTo(ServiceCity::class, 'city_id');
    }

    public function area()
    {
        return $this->belongsTo(ServiceArea::class, 'area_id');
    }

    public function technicians()
    {
        return $this->belongsToMany(User::class, 'technician_regions', 'region_id', 'technician_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'region_id');
    }
}

