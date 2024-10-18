<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
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
            $imagesString = $this->handleImageUpload($data['images']);
    
            // Tạo sản phẩm với slug và lưu ảnh
            $product = Product::create([
                'name' => $data['product_name'],
                'slug' => '', // Slug sẽ được cập nhật sau
                'category_id' => $data['category_id'],
                'price' => 100,
                'gender' => $data['gender'],
                'images' => $imagesString,
                'short_description' => $data['short_description'],
                'detail_description' => $data['description'],
                'trending' => $data['trending'] ?? 0,
                'affiliate' => $data['affiliate'] ?? 1,
                'status' => $data['status'] ?? 1,
            ]);
    
            // Tạo kích thước sản phẩm
            foreach ($data['product_variants'] as $variant) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'volume' => $variant['size'],  // Match 'size' instead of 'volume'
                    'quantity' => $variant['quantity'],
                    'price' => $variant['price'],
                    'discount' => $variant['discount'] ?? 0, // Default to 0 if not provided
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
    public function getAllProducts()
    {
        // Lấy tất cả sản phẩm cùng với kích thước
        $products = Product::with('productSizes','category')->get(); // Chỉnh sửa ở đây

        // Định dạng lại dữ liệu
        return $products->map(function ($product) {

            $imageArray = explode(',', $product->images);
            $firstImage = $imageArray[0] ?? ''; // Kiểm tra nếu có ít nhất 1 ảnh

            return [
                'id' => $product->id,
                'name' => $product->name,
                'category_name' => $product->category->name, // Hoặc lấy tên danh mục từ bảng Category nếu cần
                'images' => $firstImage, // Giả sử images là URL hoặc đường dẫn
                'product_size_list' => $product->productSizes->map(function ($size) {
                    return [
                        'id' => $size->id,
                        'size' => $size->volume,
                        'price' => $size->price,
                        'discount' => $size->discount,
                        'quantity' => $size->quantity,
                    ];
                }),
                'trending' => $product->trending, // Hoặc 1/0 tùy vào logic của bạn
            ];
        });
    }

    public function getProductDetail($id)
    {
        // Lấy sản phẩm theo ID cùng với kích thước và thuộc tính
        $product = Product::with(['productSizes', 'productAttributes'])->find($id);
        
        if (!$product) {
            return null; // Hoặc throw new NotFoundException('Product not found');
        }
    
        // Lấy các thuộc tính và giá trị cho sản phẩm cụ thể
        $attributes = $product->productAttributes->map(function ($attribute) {
            return [
                'attribute_value_id' => $attribute->attribute_value_id,
                'value' => $this->getValueByAttributeId($attribute->attribute_value_id), // Lấy giá trị cho mỗi thuộc tính
            ];
        });
    
        // Định dạng lại dữ liệu
        return [
            'id' => $product->id,
            'name' => $product->name,
            'category_id' => $product->category_id,
            'images' => $product->images,
            'short_description' => $product->short_description,
            'description' => $product->detail_description,
            'product_sizes' => $product->productSizes->map(function ($size) {
                return [
                    'id' => $size->id,
                    'size' => $size->size,
                    'price' => $size->price,
                    'discount' => $size->discount,
                    'quantity' => $size->quantity,
                ];
            }),
            'product_attributes' => $attributes, // Thêm thuộc tính vào dữ liệu
        ];        
    }
    
    // Lấy ra giá trị cho một thuộc tính cụ thể
    public function getValueByAttributeId($attributeValueId)
    {
        return AttributeValue::find($attributeValueId); // Tìm một giá trị theo ID
    }

    private function handleImageUpload($images)
    {
        if (isset($images) && is_array($images)) { // Đảm bảo images là một mảng
            $imagePaths = [];
            foreach ($images as $image) {
                // Tạo đường dẫn lưu ảnh
                $destinationPath = public_path('admin_assets/images/product'); // Đường dẫn đầy đủ đến thư mục
                // Di chuyển ảnh đến thư mục mong muốn
                $image->move($destinationPath, $image->getClientOriginalName()); // Lưu với tên gốc hoặc tạo tên mới
                
                // Lưu đường dẫn ảnh
                $imagePaths[] = '../admin_assets/images/product/' . $image->getClientOriginalName(); // Đường dẫn tương đối
            }
            // Chuyển đổi mảng đường dẫn thành chuỗi, có thể dùng ',' để ngăn cách
            return implode(',', $imagePaths);
        }
        return '';
    }


    public function deleteProduct($id)
    {
        return DB::transaction(function () use ($id) {
            // Tìm sản phẩm
            $product = Product::find($id);
            
            if (!$product) {
                // Nếu sản phẩm không tồn tại, ném một ngoại lệ hoặc trả về một phản hồi không thành công
                return response()->json(['error' => 'Sản phẩm không tồn tại.'], 404);
            }
    
            // Xóa kích thước sản phẩm
            ProductSize::where('product_id', $id)->delete();
            
            // Xóa thuộc tính sản phẩm
            ProductAttribute::where('product_id', $id)->delete();
            
            // Xóa các ảnh của sản phẩm
            $images = explode(',', $product->images);
            foreach ($images as $image) {
                // Đảm bảo rằng đường dẫn là chính xác
                $imagePath = public_path('admin_assets/public/images/' . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Xóa ảnh
                }
            }
            
            // Xóa sản phẩm
            return Product::destroy($id);
        });
    }
    

    
}
