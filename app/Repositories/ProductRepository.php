<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Auth;

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
                    'entry_price' => $variant['entry_price'],
                    'inventory_quantity' => $variant['quantity'],
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
        //$products = Product::with('productSizes','category')->get(); bản ngày 6/11: ko có order
        $products = Product::with('productSizes', 'category')
                   ->orderBy('created_at', 'desc') // Sắp xếp theo created_at giảm dần
                   ->get();


        // Định dạng lại dữ liệu
        return $products->map(function ($product) {

            $imageArray = explode(',', $product->images);
            $firstImage = $imageArray[0] ?? ''; // Kiểm tra nếu có ít nhất 1 ảnh

            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'category_name' => $product->category->name, // Hoặc lấy tên danh mục từ bảng Category nếu cần
                'images' => $firstImage, // Giả sử images là URL hoặc đường dẫn
                'product_size_list' => $product->productSizes->map(function ($size) {
                    return [
                        'id' => $size->id,
                        'size' => $size->volume,
                        'price' => $size->price,
                        'discount' => $size->discount,
                        'quantity' => $size->quantity,
                        'entry_price' => $size->entry_price,
                        'inventory_quantity' => $size->inventory_quantity,
                    ];
                }),
                'view' => $product->view,
                'trending' => $product->trending, // Hoặc 1/0 tùy vào logic
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
                    'entry_price' => $size->entry_price,
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


    //update product v cũ: khi update xóa phân loại cũ => bị xóa trong order
    public function updateProduct2($id, $data)
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

    //update product mới: khi update giữ nguyên phân loại cũ
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
            foreach ($data['product_variants'] as $variant) {
                // Kiểm tra xem kích thước đã tồn tại chưa
                $productSize = ProductSize::where('product_id', $product->id)
                                        ->where('volume', $variant['oldSize'])
                                        ->first();
                
                if ($productSize) {
                    // Nếu kích thước đã tồn tại, cập nhật thông tin
                    $productSize->volume = $variant['size'];
                    $productSize->quantity = $variant['quantity'];
                    $productSize->price = $variant['price'];
                    $productSize->entry_price = $variant['entry_price'];
                    $productSize->discount = $variant['discount'] ?? 0;
                    $productSize->save();
                } else {
                    // Nếu kích thước chưa tồn tại, tạo mới
                    ProductSize::create([
                        'product_id' => $product->id,
                        'volume' => $variant['size'],
                        'quantity' => $variant['quantity'],
                        'price' => $variant['price'],
                        'discount' => $variant['discount'] ?? 0,
                    ]);
                }
            }

            // Cập nhật thuộc tính
            foreach ($data['attributes'] as $index => $attribute) {
                // Lấy tất cả các bản ghi của product_id
                $productAttributes = ProductAttribute::where('product_id', $product->id)
                                                    ->get(); // Lấy tất cả các bản ghi có cùng product_id
            
                // Lấy bản ghi theo thứ tự để cập nhật `attribute_value_id` theo thứ tự bạn muốn
                if (isset($productAttributes[$index])) {
                    // Cập nhật giá trị của attribute_value_id theo thứ tự
                    $productAttributes[$index]->update([
                        'attribute_value_id' => $attribute['value_id']
                    ]);
                }
            }
            

            return $product; // Đảm bảo trả về sản phẩm đã được cập nhật
        });
    }

    //soft delete
    public function softDeleteProduct($id)
    {
        //chuyển is_deleted thành 1
        $product = Product::find($id);
        $product->is_deleted = 1;
        $product->save();
        
    }

    //update view
    public function updateView($product_id)
    {
        $product = Product::find($product_id);
        $product->view = $product->view + 1;
        $product->save();
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
                return $this->getBestSellerProducts($limit);
                //$productIds = $this->getBestSellerProductIds($limit); // Hàm giả định để lấy ID sản phẩm bán chạy
                //return $this->getProducts($limit, $productIds);
    
            case 'top_view':
                //$productIds = $this->getTopViewedProductIds($limit); // Hàm giả định để lấy ID sản phẩm xem nhiều
                //return $this->getProducts($limit, $productIds);
                return $this->getTopViewedProducts($limit);
        }
    }
    
    public function getProducts($limit, $productIds = null)
    {   
        $query = $limit ? $this->product->with('productSizes')->limit($limit) : $this->product;

        //9-11-2024:$query = $limit = null ? $this->product->with('productSizes')->limit($limit) : $this->product;
        //$query = $this->product->with('productSizes')->limit($limit);

        //Thêm sắp xếp
        $query->orderBy('id', 'desc');
  
    
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
    protected function getTopViewedProductIds($limit)
    {
        // Lấy danh sách các sản phẩm có số lượt xem giảm dần
        return \DB::table('products')
            ->orderBy('view', 'desc')  // Sắp xếp theo số lượt xem giảm dần
            ->limit($limit)  // Giới hạn số lượng sản phẩm
            ->pluck('id');  // Lấy chỉ id của các sản phẩm
    }

    //version 9/11/2024
    public function getTopViewedProducts($limit)
    {
        // Truy vấn SQL raw để lấy các sản phẩm có lượt xem cao nhất và chỉ lấy kích thước đầu tiên
        $products = \DB::select(
            \DB::raw("
                SELECT p.id AS product_id, 
                       p.name AS product_name, 
                       ps.id AS product_size_id, 
                       ps.volume AS size, 
                       ps.price, 
                       p.view,
                       ps.discount, 
                       p.slug, 
                       TRIM(SUBSTRING_INDEX(p.images, ',', 1)) AS image
                FROM products p
                JOIN product_sizes ps ON ps.product_id = p.id
                JOIN (
                    SELECT id 
                    FROM products
                    ORDER BY view DESC
                    LIMIT :limit
                ) AS top_products ON top_products.id = p.id
                WHERE ps.id IN (
                    SELECT MIN(id) 
                    FROM product_sizes 
                    WHERE product_id = p.id
                    GROUP BY product_id
                )
                ORDER BY p.view DESC
            "), 
            ['limit' => $limit] // Gán tham số limit vào truy vấn
        );
    
        // Xử lý và trả về kết quả dưới dạng mảng sản phẩm với thông tin cần thiết
        return collect($products)->map(function ($product) {
            return (object)[
                'product_id' => $product->product_id,
                'slug' => $product->slug,
                'product_name' => $product->product_name,
                'product_size_id' => $product->product_size_id,
                'size' => $product->size,
                'image' => $product->image,
                'price' => $product->price,
                'discount' => $product->discount,
                'view' => $product->view,
            ];
        });
    }

    //hàm gốc
    public function getBestSellerProducts2($limit)
    {
        // Lấy danh sách các sản phẩm bán chạy nhất
        $products = \DB::select(
            \DB::raw("
                SELECT p.id AS product_id, 
                       p.name AS product_name, 
                       ps.id AS product_size_id, 
                       ps.volume AS size, 
                       ps.price, 
                       ps.discount, 
                       p.slug, 
                       TRIM(SUBSTRING_INDEX(p.images, ',', 1)) AS image
                FROM products p
                JOIN product_sizes ps ON ps.product_id = p.id
                JOIN (
                    SELECT product_size_id 
                    FROM order_items
                    GROUP BY product_size_id
                    ORDER BY SUM(quantity) DESC
                    LIMIT :limit
                ) AS best_sellers ON best_sellers.product_size_id = ps.id
                WHERE ps.id IN (
                    SELECT MIN(id) 
                    FROM product_sizes 
                    WHERE product_id = p.id
                    GROUP BY product_id
                )
            "), 
            ['limit' => $limit] // Gán tham số limit vào truy vấn
        );
    
        // Xử lý và trả về kết quả dưới dạng mảng sản phẩm với thông tin cần thiết
        return collect($products)->map(function ($product) {
            return (object)[
                'product_id' => $product->product_id,
                'slug' => $product->slug,
                'product_name' => $product->product_name,
                'product_size_id' => $product->product_size_id,
                'size' => $product->size,
                'image' => $product->image,
                'price' => $product->price,
                'discount' => $product->discount,
            ];
        });
    }

    //Lấy ra sản phẩm bán chạy nhất (tách theo từng phân loại)
    public function getBestSellerProducts3($limit)
    {
        // Thực thi câu lệnh SQL raw query
        $products = \DB::table('products as p')
            ->select(
                'p.id as product_id',
                'p.name as product_name',
                'ps.id as product_size_id',
                'ps.volume as size',
                'ps.price',
                'ps.discount',
                'p.slug',
                \DB::raw('TRIM(SUBSTRING_INDEX(p.images, \',\', 1)) AS image'),
                \DB::raw('SUM(oi.quantity) AS total_sales') // Tính tổng số lượng bán
            )
            ->join('product_sizes as ps', 'ps.product_id', '=', 'p.id') // Kết nối bảng product_sizes
            ->join('order_items as oi', 'oi.product_size_id', '=', 'ps.id') // Kết nối bảng order_items để tính tổng số lượng
            ->join(
                \DB::raw(
                    '(SELECT oi.product_size_id
                      FROM order_items oi
                      GROUP BY oi.product_size_id
                      ORDER BY SUM(oi.quantity) DESC 
                      LIMIT ' . (int) $limit . ') AS best_sellers'
                ),
                'best_sellers.product_size_id',
                '=',
                'ps.id'
            )
            ->groupBy('p.id', 'ps.id') // Nhóm theo sản phẩm và phân loại sản phẩm
            ->limit($limit)  // Giới hạn số lượng sản phẩm bán chạy
            ->get()
            ->map(function ($product) {
                // Trả về các thuộc tính cần thiết và hiển thị ảnh đầu tiên
                return (object) [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'product_size_id' => $product->product_size_id,
                    'size' => $product->size,
                    'discount' => $product->discount,
                    'slug' => $product->slug,
                    'image' => trim($product->image), // Lấy ảnh đầu tiên của sản phẩm
                    'total_sales' => $product->total_sales // Số lượng bán
                ];
            });
    
        return $products;
    }
    
    //Lấy ra sản phẩm bán chạy nhất (gộp các phân loại)
    public function getBestSellerProducts($limit)
    {
        // Thực thi câu lệnh SQL raw query
        $products = \DB::table('products as p')
            ->select(
                'p.id as product_id',
                'p.name as product_name',
                \DB::raw('SUM(oi.quantity) AS total_sales'), // Tính tổng số lượng bán của tất cả các phân loại
                \DB::raw('MIN(ps.volume) as size'), // Sử dụng MIN() để lấy giá trị size đại diện
                \DB::raw('MIN(ps.price) as price'), // Sử dụng MIN() hoặc MAX() để lấy giá trị giá đại diện
                \DB::raw('MAX(ps.discount) as discount'), // Lấy giá trị discount đại diện
                'p.slug',
                \DB::raw('TRIM(SUBSTRING_INDEX(p.images, \',\', 1)) AS image'), // Lấy ảnh đầu tiên
                \DB::raw('MIN(ps.id) as product_size_id') // Lấy product_size_id đầu tiên (hoặc có thể là MIN hoặc MAX)
            )
            ->join('product_sizes as ps', 'ps.product_id', '=', 'p.id') // Kết nối bảng product_sizes
            ->join('order_items as oi', 'oi.product_size_id', '=', 'ps.id') // Kết nối bảng order_items để tính tổng số lượng
            ->join(
                \DB::raw(
                    '(SELECT oi.product_size_id
                    FROM order_items oi
                    GROUP BY oi.product_size_id
                    ORDER BY SUM(oi.quantity) DESC 
                    LIMIT ' . (int) $limit . ') AS best_sellers'
                ),
                'best_sellers.product_size_id',
                '=',
                'ps.id'
            )
            ->groupBy('p.id', 'p.name', 'p.slug', 'p.images') // Thêm 'p.name', 'p.slug', 'p.images' vào GROUP BY
            ->orderBy('total_sales', 'desc') // Sắp xếp theo số lượng bán giảm dần
            ->limit($limit)  // Giới hạn số lượng sản phẩm bán chạy
            ->get()
            ->map(function ($product) {
                // Trả về các thuộc tính cần thiết và hiển thị ảnh đầu tiên
                return (object) [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'slug' => $product->slug,
                    'image' => trim($product->image), // Lấy ảnh đầu tiên của sản phẩm
                    'total_sales' => $product->total_sales, // Tổng số lượng bán của sản phẩm
                    'product_size_id' => $product->product_size_id, // Kích thước đại diện
                    'size' => $product->size, // Kích thước đại diện
                ];
            });

        return $products;
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

        //update view
        $product_id = $product->id;
        $this->updateView($product_id);
    
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
            ->where('id', '!=', $product_id)
            ->with('productSizes') // Load productSizes relationship
            ->limit(5)
            ->get()
            ->map(function ($product) {
                // Set price to the first size's price
                if ($product->productSizes->isNotEmpty()) {
                    $firstSize = $product->productSizes->first();
                    $product->price = $firstSize->price + $firstSize->price*$firstSize->discount/100;
                    $product->product_size_id = $firstSize->id;
                    $product->discount = $firstSize->discount;
                    $product->discounted_price = $firstSize->price;
                    $product->size = $firstSize->volume;
                }
    
                // Get only the first image from the images string
                $imagesArray = explode(',', $product->images);
                $product->image = trim($imagesArray[0]);
    
                // Trả về các trường mong muốn
                return $product->only(['id', 'slug', 'name', 'product_size_id', 'image', 'price', 'discount','discounted_price','size']);
            });
    }
    
    public function getSimilarProducts1($product_id)
    {
        // Call the external API to get similar products based on the product_id
        $response = Http::get('http://127.0.0.1:8080/recommend', [
            'product_id' => $product_id
        ]);
    
        // Process the response data
        $products = $response->json();
        
        // Check if the API returned data successfully
        if ($products['code'] === 200 && isset($products['data'])) {
            $similarProducts = $products['data'];
            
            // Map the similar products to the desired format
            $similarProductIds = collect($similarProducts)->pluck('product_id')->toArray();
    
            // Fetch the products from the database based on the IDs
            $relatedProducts = $this->product
                ->whereIn('id', $similarProductIds) // Get products by IDs
                ->with('productSizes') // Load productSizes relationship
                ->get()
                ->map(function ($product) {
                    // Set price to the first size's price
                    if ($product->productSizes->isNotEmpty()) {
                        $firstSize = $product->productSizes->first();
                        $product->price = $firstSize->price;
                        $product->product_size_id = $firstSize->id;
                        $product->discount = $firstSize->discount;
                        $product->discounted_price = $firstSize->price - $firstSize->price * $firstSize->discount / 100;
                    }
    
                    // Get only the first image from the images string
                    $imagesArray = explode(',', $product->images);
                    $product->image = trim($imagesArray[0]);
    
                    // Return the desired fields
                    return $product->only(['id', 'slug', 'name', 'product_size_id', 'image', 'price', 'discount', 'discounted_price']);
                });
    
            return $relatedProducts;
        } else {
            $products = $this->getRelatedProduct($product_id);
        }
    
        // If no data is returned or the response is not successful, return null
        return null;
    }
    
    //Hàm lấy sản phẩm gợi ý lấy data trực tiếp từ DB (triển khai vps)
    public function getSimilarProducts($product_id)
    {
        try {
            // Sử dụng throw() để ném ngoại lệ nếu có lỗi HTTP
            $response = Http::get('http://127.0.0.1:8080/recommend', [
                'product_id' => $product_id
            ])->throw();
            
            // Xử lý dữ liệu phản hồi
            $products = $response->json();
            
            // Kiểm tra nếu API trả về dữ liệu thành công
            if ($products['code'] === 200 && isset($products['data'])) {
                $similarProducts = $products['data'];
                
                // Lấy danh sách product_id từ kết quả trả về
                $similarProductIds = collect($similarProducts)->pluck('product_id')->toArray();
    
                // Truy vấn sản phẩm từ database theo danh sách ID
                $relatedProducts = $this->product
                    ->whereIn('id', $similarProductIds)
                    ->with('productSizes')
                    ->get()
                    ->map(function ($product) {
                        if ($product->productSizes->isNotEmpty()) {
                            $firstSize = $product->productSizes->first();
                            $product->price = $firstSize->price + $firstSize->price * $firstSize->discount / 100;
                            $product->product_size_id = $firstSize->id;
                            $product->discount = $firstSize->discount;
                            $product->discounted_price = $firstSize->price;
                            $product->size = $firstSize->volume;
                        }
    
                        $imagesArray = explode(',', $product->images);
                        $product->image = trim($imagesArray[0]);
    
                        return $product->only(['id', 'slug', 'name', 'product_size_id', 'image', 'price', 'discount', 'discounted_price', 'size']);
                    });
    
                // Sắp xếp lại theo thứ tự của similarProductIds
                $relatedProducts = $relatedProducts->sortBy(function ($product) use ($similarProductIds) {
                    return array_search($product['id'], $similarProductIds);
                })->values();
    
                return $relatedProducts;
            } else {
                return $this->getRelatedProduct($product_id);
            }
        } catch (\Exception $e) {
            // Log lỗi nếu có ngoại lệ
            \Log::error('Error fetching similar products: ' . $e->getMessage());
            return $this->getRelatedProduct($product_id);
        }
    }

    public function getCollaborativeFiltering($request){
        if (isset(Auth::user()->id)) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 3; //Mặc định cho view
        }
        try {
            // Sử dụng throw() để ném ngoại lệ nếu có lỗi HTTP
            $response = Http::get('http://127.0.0.1:8080/collaborative', [
                'user_id' => $user_id
            ])->throw();
            
            // Xử lý dữ liệu phản hồi
            $products = $response->json();
            
            // Kiểm tra nếu API trả về dữ liệu thành công
            if ($products['code'] === 200 && isset($products['data'])) {
                $recommendProducts = $products['data'];
                
                // Lấy danh sách product_id từ kết quả trả về
                $recommendProductIds = collect($recommendProducts)->pluck('product_id')->toArray();
    
                // Truy vấn sản phẩm từ database theo danh sách ID
                
    
                return  $recommendProductIds;
            } else {
                return $this->getRelatedProduct($user_id);
            }
        } catch (\Exception $e) {
            // Log lỗi nếu có ngoại lệ
            \Log::error('Error fetching recommend products: ' . $e->getMessage());
            return $this->getRelatedProduct($user_id);
        }     
    }

    public function getCollaborativeFiltering2($request){
        if (isset(Auth::user()->id)) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 3; //Mặc định cho view
        }
        try {
            // Sử dụng throw() để ném ngoại lệ nếu có lỗi HTTP
            $response = Http::get('http://127.0.0.1:8080/collaborative-2', [
                'user_id' => $user_id
            ])->throw();
            
            // Xử lý dữ liệu phản hồi
            $products = $response->json();
            
            // Kiểm tra nếu API trả về dữ liệu thành công
            if ($products['code'] === 200 && isset($products['data'])) {
                $recommendProducts = $products['data'];
                
                // Lấy danh sách product_id từ kết quả trả về
                $recommendProductIds = collect($recommendProducts)->pluck('product_id')->toArray();
    
                // Truy vấn sản phẩm từ database theo danh sách ID
                
    
                return  $recommendProductIds;
            } else {
                return $this->getRelatedProduct($user_id);
            }
        } catch (\Exception $e) {
            // Log lỗi nếu có ngoại lệ
            \Log::error('Error fetching recommend products: ' . $e->getMessage());
            return $this->getRelatedProduct($user_id);
        }     
    }

    //Lấy sản phẩm & lịch sử mua trực tiếp từ DB (recommend_service triển khai host riêng, gọi qua api)
    public function getProductsFromDB()
    {
        // Truy vấn lấy tất cả sản phẩm và các thuộc tính liên quan
        return DB::table('products as p')
            ->select(
                'p.id as product_id',
                'p.name as product_name',
                DB::raw("MAX(CASE WHEN a.id = 1 THEN av.value END) AS 'nong_do'"),
                DB::raw("MAX(CASE WHEN a.id = 2 THEN av.value END) AS 'phong_cach'"),
                DB::raw("MAX(CASE WHEN a.id = 3 THEN av.value END) AS 'nhom_huong'"),
                DB::raw("MAX(CASE WHEN a.id = 4 THEN av.value END) AS 'do_luu_huong'"),
                DB::raw("MAX(CASE WHEN a.id = 5 THEN av.value END) AS 'do_toa_huong'"),
                DB::raw("MAX(CASE WHEN a.id = 6 THEN av.value END) AS 'xuat_xu'"),
                DB::raw("MAX(CASE WHEN a.id = 7 THEN av.value END) AS 'thuong_hieu'"),
                DB::raw("MAX(CASE WHEN a.id = 8 THEN av.value END) AS 'nhom_tuoi'")
            )
            ->join('Product_Attributes as pa', 'p.id', '=', 'pa.product_id')
            ->join('Attribute_Values as av', 'pa.attribute_value_id', '=', 'av.id')
            ->join('Attributes as a', 'av.attribute_id', '=', 'a.id')
            ->groupBy('p.id', 'p.name')
            ->get();
    }

    public function getProductsForRecommend()
    {
        try {
            // Lấy tất cả sản phẩm
            $products = $this->getProductsFromDB();

            if ($products->isEmpty()) {
                return response()->json(['message' => 'Không tìm thấy sản phẩm', 'code' => 404], 404);
            }

            // Chuyển kết quả thành mảng dữ liệu theo định dạng yêu cầu
            $productData = $products->map(function ($product) {
                return [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'combined_features' => "{$product->nong_do} {$product->phong_cach} {$product->nhom_huong} "
                        . "{$product->do_luu_huong} {$product->do_toa_huong} {$product->xuat_xu} "
                        . "{$product->thuong_hieu} {$product->nhom_tuoi}",
                ];
            });

            // Chuẩn bị dữ liệu để gửi lên server
            $responseData = [
                'product_id' => 101, // Hoặc giá trị từ request, tùy theo yêu cầu
                'data' => $productData
            ];

            // Trả về kết quả theo định dạng yêu cầu
            //return response()->json($responseData);
            return $responseData;

        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi từ server: ' . $e->getMessage(), 'code' => 500], 500);
        }
    }    
    
    // Hàm lấy dữ liệu mua hàng của người dùng
    public function getUserPurchasesFromDB()
    {
        // Truy vấn dữ liệu mua hàng của người dùng
        return DB::table('orders as o')
            ->join('order_items as oi', 'oi.order_id', '=', 'o.id')
            ->join('product_sizes as ps', 'ps.id', '=', 'oi.product_size_id')
            ->join('products as pd', 'pd.id', '=', 'ps.product_id')
            ->select('o.customer_id', 'pd.id as product_id')
            ->get();
    }
    public function getUserPurchasesForRecommend()
    {
        try {
            // Lấy dữ liệu mua hàng
            $purchases = $this->getUserPurchasesFromDB();

            if ($purchases->isEmpty()) {
                return response()->json(['message' => 'Không có dữ liệu mua hàng', 'code' => 404], 404);
            }

            // Lọc dữ liệu theo user_id từ request
            //$userId = $request->input('user_id');
            $userId = 3;
            $userPurchases = $purchases->where('customer_id', $userId);

            if ($userPurchases->isEmpty()) {
                return response()->json(['message' => 'Không tìm thấy dữ liệu mua hàng của người dùng', 'code' => 404], 404);
            }

            // Chuẩn bị dữ liệu theo định dạng yêu cầu
            $responseData = [
                'user_id' => $userId,  // user_id của người dùng cần đề xuất
                'data' => $purchases->map(function ($purchase) {
                    return [
                        'customer_id' => $purchase->customer_id,
                        'product_id' => $purchase->product_id,
                    ];
                })->values()->all() // Chuyển thành mảng dữ liệu mà không có key index
            ];

            // Trả về dữ liệu theo định dạng yêu cầu
            //return response()->json($responseData);
            return $responseData;

        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi từ server: ' . $e->getMessage(), 'code' => 500], 500);
        }
    }

    public function getSimilarProducts_Ngrok($product_id)
    {
        try {
            // Lấy tất cả các sản phẩm và các đặc điểm của chúng
            $productsForRecommend = $this->getProductsForRecommend();

            if (empty($productsForRecommend['data'])) {
                return response()->json(['message' => 'Không có dữ liệu sản phẩm', 'code' => 404], 404);
            }

            // Gửi yêu cầu đến API /recommend với dữ liệu sản phẩm đã lấy
            $response = Http::post('https://b6a9-104-154-160-80.ngrok-free.app/recommend', [
                'product_id' => $product_id,
                'data' => $productsForRecommend['data']
            ])->throw();

            // Xử lý dữ liệu phản hồi từ API
            $products = $response->json();

            if ($products['code'] === 200 && isset($products['data'])) {
                $similarProducts = $products['data'];

                // Lấy danh sách product_id từ kết quả trả về
                $similarProductIds = collect($similarProducts)->pluck('product_id')->toArray();

                // Truy vấn sản phẩm từ database theo danh sách ID
                $relatedProducts = $this->product
                    ->whereIn('id', $similarProductIds)
                    ->with('productSizes')
                    ->get()
                    ->map(function ($product) {
                        if ($product->productSizes->isNotEmpty()) {
                            $firstSize = $product->productSizes->first();
                            $product->price = $firstSize->price + $firstSize->price * $firstSize->discount / 100;
                            $product->product_size_id = $firstSize->id;
                            $product->discount = $firstSize->discount;
                            $product->discounted_price = $firstSize->price;
                            $product->size = $firstSize->volume;
                        }

                        $imagesArray = explode(',', $product->images);
                        $product->image = trim($imagesArray[0]);

                        return $product->only(['id', 'slug', 'name', 'product_size_id', 'image', 'price', 'discount', 'discounted_price', 'size']);
                    });

                // Sắp xếp lại theo thứ tự của similarProductIds
                $relatedProducts = $relatedProducts->sortBy(function ($product) use ($similarProductIds) {
                    return array_search($product['id'], $similarProductIds);
                })->values();

                return $relatedProducts;
            } else {
                return $this->getRelatedProduct($product_id); // fallback
            }
        } catch (\Exception $e) {
            // Log lỗi nếu có ngoại lệ
            \Log::error('Error fetching similar products: ' . $e->getMessage());
            return $this->getRelatedProduct($product_id); // fallback
        }
    }
    public function getCollaborativeFiltering_Ngrok($request)
    {
        // Lấy user_id từ session hoặc mặc định là 3
        //$user_id = Auth::check() ? Auth::user()->id : 3;
        $user_id = $request->user_id;
    
        try {
            // Lấy dữ liệu mua hàng của người dùng từ getUserPurchasesForRecommend
            $userPurchasesForRecommend = $this->getUserPurchasesForRecommend();
    
            if (empty($userPurchasesForRecommend['data'])) {
                return response()->json(['message' => 'Không có dữ liệu mua hàng của người dùng', 'code' => 404], 404);
            }
    
            // Gửi yêu cầu đến API /collaborative với dữ liệu mua hàng của người dùng
            $response = Http::post('http://127.0.0.1:8080/collaborative', [
                'user_id' => $user_id,
                'data' => $userPurchasesForRecommend['data']
            ])->throw();
    
            // Xử lý dữ liệu phản hồi từ API
            $products = $response->json();
    
            if ($products['code'] === 200 && isset($products['data'])) {
                $recommendProducts = $products['data'];
    
                // Lấy danh sách product_id từ kết quả trả về
                $recommendProductIds = collect($recommendProducts)->pluck('product_id')->toArray();
    
                // Truy vấn sản phẩm từ database theo danh sách ID
                $recommendedProducts = $this->product
                    ->whereIn('id', $recommendProductIds)
                    ->with('productSizes')
                    ->get()
                    ->map(function ($product) {
                        if ($product->productSizes->isNotEmpty()) {
                            $firstSize = $product->productSizes->first();
                            $product->price = $firstSize->price + $firstSize->price * $firstSize->discount / 100;
                            $product->product_size_id = $firstSize->id;
                            $product->discount = $firstSize->discount;
                            $product->discounted_price = $firstSize->price;
                            $product->size = $firstSize->volume;
                        }
    
                        $imagesArray = explode(',', $product->images);
                        $product->image = trim($imagesArray[0]);
    
                        return $product->only(['id', 'slug', 'name', 'product_size_id', 'image', 'price', 'discount', 'discounted_price', 'size']);
                    });
    
                return $recommendedProducts;
            } else {
                return $this->getRelatedProduct($user_id); // fallback
            }
        } catch (\Exception $e) {
            // Log lỗi nếu có ngoại lệ
            \Log::error('Error fetching recommended products: ' . $e->getMessage());
            return $this->getRelatedProduct($user_id); // fallback
        }
    }
    

}
