<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'pre_value',
        'discount',
        'value',
        'name',
        'phone',
        'address',
        'description',
        'order_date',
        'payment_status',
        'status',
        'log',
        'payment_method',
        'shipping_code',
        'shipping_cost',
        'delivery_company_code',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

