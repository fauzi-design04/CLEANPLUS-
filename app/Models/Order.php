<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'order_date',
        'order_time',
        'duration',
        'total_price',
        'address',
        'kecamatan',
        'kelurahan',
        'phone',
        'special_instructions',
        'status',
        'confirmed at'
    ];

    protected $casts = [
        'order_date' => 'date',
        'confirmed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}