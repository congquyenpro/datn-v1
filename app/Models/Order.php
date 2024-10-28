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
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

}

