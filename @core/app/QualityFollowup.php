<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityFollowup extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'created_by',
        'rating',
        'notes',
        'client_feedback',
        'technician_feedback',
        'status'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function qualityAgent()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

