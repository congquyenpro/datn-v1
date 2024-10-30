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
        $this->product = $product;
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
                'attribute_value' => $this->getValueByAttributeId($attribute->attribute_value_id), // Lấy giá trị cho mỗi thuộc tính
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
            'affiliate' => $product->affiliate,
            'status' => $product->status,
            'gender' => $product->gender,
            'product_sizes' => $product->productSizes->map(function ($size) {
                return [
                    'id' => $size->id,
                    'size' => $size->volume,
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


    //update product
    public function updateProduct($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Tìm sản phẩm cần cập nhật
            $product = Product::findOrFail($id);
    
            // Xử lý ảnh tải lên, nếu có hình ảnh mới
            if (isset($data['images'])) {
                $imagesString = $this->handleImageUpload($data['images']);
                $product->images = $imagesString; // Cập nhật hình ảnh
            }
    
            // Cập nhật thông tin sản phẩm
            $product->name = $data['product_name'];
            $product->category_id = $data['category_id'];
            $product->gender = $data['gender'];
            $product->short_description = $data['short_description'];
            $product->detail_description = $data['description'];
            $product->trending = $data['trending'] ?? 0;
            $product->affiliate = $data['affiliate'] ?? 1;
            $product->status = $data['status'] ?? 1;
    
            // Lưu thay đổi của sản phẩm
            $product->save();
    
            // Cập nhật kích thước sản phẩm
            // Xóa kích thước cũ
            ProductSize::where('product_id', $product->id)->delete();
    
            foreach ($data['product_variants'] as $variant) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'volume' => $variant['size'],
                    'quantity' => $variant['quantity'],
                    'price' => $variant['price'],
                    'discount' => $variant['discount'] ?? 0,
                ]);
            }
    
            // Cập nhật thuộc tính
            // Xóa thuộc tính cũ
            ProductAttribute::where('product_id', $product->id)->delete();
    
            foreach ($data['attributes'] as $attribute) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_value_id' => $attribute['value_id'],
                ]);
            }
    
            return $product; // Đảm bảo trả về sản phẩm đã được cập nhật
        });
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
    
    public function getProductByType($type, $limit = 12)
    {
        switch ($type) {
            case 'new':
                return $this->getProducts($limit);
    
            case 'best':
                // Lấy sản phẩm từ bảng order_item (giả sử có phương thức để lấy best-seller)
                $productIds = $this->getBestSellerProductIds($limit); // Hàm giả định để lấy ID sản phẩm bán chạy
                return $this->getProducts($limit, $productIds);
    
            // Thêm các case khác nếu cần
        }
    }
    
    public function getProducts($limit, $productIds = null)
    {
        $query = $limit = null ? $this->product->with('productSizes')->limit($limit) : $this->product;
        //$query = $this->product->with('productSizes')->limit($limit);
    
        if ($productIds) {
            $query->whereIn('id', $productIds); // Thêm điều kiện nếu có productIds
        }
    
        return $query->get()->map(function ($product) {
            if ($product->productSizes->isNotEmpty()) {
                $firstSize = $product->productSizes->first();
                $product->product_id = $product->id;
                $product->product_name = $product->name;
                $product->price = $firstSize->price; // Gán giá bằng giá của kích thước đầu tiên
                $product->product_size_id = $firstSize->id; // Gán ID kích thước đầu tiên
                $product->size = $firstSize->volume; // Gán kích thước
                $product->discount = $firstSize->discount; // Gán giảm giá
            }
            $imagesArray = explode(',', $product->images); // Chia chuỗi thành mảng
            $product->image = trim($imagesArray[0]); // Lấy ảnh đầu tiên và loại bỏ khoảng trắng
            return $product->only(['product_id', 'slug', 'product_name', 'product_size_id', 'size', 'image', 'price', 'discount']);
        });
    }
    protected function getBestSellerProductIds($limit)
    {
        // Lấy product_size_id bán chạy nhất
        $bestSellerProductSizeIds = \DB::table('order_items')
            ->select('product_size_id')
            ->groupBy('product_size_id')
            ->orderByRaw('SUM(quantity) DESC')
            ->limit($limit)
            ->pluck('product_size_id');

        // Lấy product_id tương ứng từ product_sizes
        return \DB::table('product_sizes')
            ->whereIn('id', $bestSellerProductSizeIds)
            ->pluck('product_id')
            ->unique(); // Trả về danh sách product_id duy nhất
    }


    
    public function getProductBySlug($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('productSizes', 'productAttributes.attributeValue') // Eager load relationships
            ->first(); // Or use firstOrFail() for 404
    
        // set giá mặc định = giá first size
        if ($product && $product->productSizes->isNotEmpty()) {
            $product->price = $product->productSizes->first()->price;
        } else {
            $product->price = null; // Handle case when no sizes are available
        }
    
        return $product;
    }
    public function getRelatedProduct($product_id)
    {
        $product = $this->product->find($product_id);
        if (!$product) {
            return null;
        }
    
        $categoryId = $product->category_id;
    
        return $this->product
            ->where('category_id', $categoryId)
            ->with('productSizes') // Load productSizes relationship
            ->limit(5)
            ->get()
            ->map(function ($product) {
                // Set price to the first size's price
                if ($product->productSizes->isNotEmpty()) {
                    $firstSize = $product->productSizes->first();
                    $product->price = $firstSize->price;
                    $product->product_size_id = $firstSize->id;
                    $product->discount = $firstSize->discount;
                    $product->discounted_price = $firstSize->price - $firstSize->price*$firstSize->discount/100;
                }
    
                // Get only the first image from the images string
                $imagesArray = explode(',', $product->images);
                $product->image = trim($imagesArray[0]);
    
                // Trả về các trường mong muốn
                return $product->only(['id', 'slug', 'name', 'product_size_id', 'image', 'price', 'discount','discounted_price']);
            });
    }
    
    
    
    

    
}
