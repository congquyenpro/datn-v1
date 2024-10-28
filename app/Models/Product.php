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

    /*Có thể tự định nghĩa khóa ngoại nếu ko đặt tên chuẩn return $this->hasOne(Phone::class, 'foreign_key'); */

    public function category()
    {
        //không truyền 'foreign_key' mặc định khóa ngoại 'Tên Model'+_id
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
