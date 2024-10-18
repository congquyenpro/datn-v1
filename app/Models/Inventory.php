<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_size_id', 
        'stock_quantity'
    ];

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }
}
