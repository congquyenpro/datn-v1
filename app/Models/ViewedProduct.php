<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewedProduct extends Model
{
    protected $fillable = [
        'customer_id', 
        'product_id', 
        'viewed_at'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
