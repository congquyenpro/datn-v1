<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'shipping_id', 
        'order_id', 
        'customer_id', 
        'partner', 
        'COD', 
        'fee', 
        'other_fee', 
        'total_fee', 
        'shipping_status', 
        'ds_status', 
        'admin_id', 
        'expected_delivery_time', 
        'shipping_log'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
