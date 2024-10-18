<?php 

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function addNewProduct($data)
    {
        // Tạo slug từ tên sản phẩm
        $slug = Str::slug($data['product']['name']);
        
        // Tạo sản phẩm trước
        $product = $this->productRepository->createProduct($data);

        // Cập nhật slug với ID sản phẩm để đảm bảo tính duy nhất
        $product->slug = $this->generateUniqueSlug($slug, $product->id);
        $product->save(); // Lưu thay đổi

        return $product;
    }

    private function generateUniqueSlug($slug, $productId)
    {
        $baseSlug = $slug;
        $count = 0;

        // Kiểm tra slug đã tồn tại chưa
        while (\App\Models\Product::where('slug', $slug)->where('id', '<>', $productId)->exists()) {
            $count++;
            $slug = "{$baseSlug}-{$count}"; // Thêm số đếm vào slug
        }

        return $slug;
    }
}
