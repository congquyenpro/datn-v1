<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    protected $fillable = [
        'product_size_id', 
        'entry_date', 
        'quantity', 
        'entry_price', 
        'supplier_name', 
        'expiry_date', 
        'admin_id'
    ];

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
