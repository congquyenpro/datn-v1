<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends BaseRepository 
{
    protected $product;

    public function __construct(Product $product) 
    {
        parent::__construct($product);
    }

    public function createProduct($data)
    {
        return DB::transaction(function () use ($data) {
            // Xử lý ảnh tải lên
            $imagesString = $this->handleImageUpload($data['product']['images']);
    
            // Tạo sản phẩm với slug và lưu ảnh
            $product = Product::create([
                'name' => $data['product']['name'],
                'slug' => '', // Slug sẽ được cập nhật sau
                'category_id' => $data['product']['category_id'],
                'price' => $data['product']['price'],
                'gender' => $data['product']['gender'],
                'images' => $imagesString,
                'short_description' => $data['product']['short_description'],
                'detail_description' => $data['product']['detail_description'],
                'trending' => $data['product']['trending'] ?? 0,
                'affiliate' => $data['product']['affiliate'] ?? 1,
                'status' => $data['product']['status'] ?? 1,
            ]);
    
            // Tạo kích thước sản phẩm
            foreach ($data['sizes'] as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'volume' => $size['volume'],
                    'quantity' => $size['quantity'],
                    'price' => $size['price'],
                    'discount' => $size['discount'] ?? 0,
                ]);
            }
    
            // Liên kết các thuộc tính
            foreach ($data['attributes'] as $attribute) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_value_id' => $attribute['value_id'],
                ]);
            }
    
            return $product; // Đảm bảo trả về sản phẩm
        });
    }
    

    private function handleImageUpload($images)
    {
        if (isset($images) && is_array($images)) { // Đảm bảo images là một mảng
            $imagePaths = [];
            foreach ($images as $image) {
                // Lưu ảnh vào thư mục public/admin_assets/images/product
                $path = $image->store('admin_assets/images/product', 'public');
                $imagePaths[] = $path; // Lưu đường dẫn ảnh
            }
            // Chuyển đổi mảng đường dẫn thành chuỗi, có thể dùng ',' để ngăn cách
            return implode(',', $imagePaths);
        }
        return '';
    }
}
