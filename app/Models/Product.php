<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\IsDeletedScope;

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
        'is_deleted',
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

    protected static function booted()
    {
        // Áp dụng global scope trong hàm booted
        static::addGlobalScope(new IsDeletedScope);
    }

    //ngoại lệ cho thùng rác
    // Lấy tất cả sản phẩm (bao gồm cả sản phẩm đã xóa)
    /* $productsIncludingDeleted = Product::withoutGlobalScope(IsDeletedScope::class)->get(); */
/*     $deletedProducts = Product::withoutGlobalScope(IsDeletedScope::class)
                          ->where('is_deleted', 1)
                          ->get(); */

    //hoặc // Lấy tất cả sản phẩm đã bị xóa mềm (dùng Soft Deletes)
    /* $deletedProducts = Product::onlyTrashed()->get(); */
}
