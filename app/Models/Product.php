<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'gender',
        'images',
        'short_description',
        'detail_description',
        'trending',
        'affiliate',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
