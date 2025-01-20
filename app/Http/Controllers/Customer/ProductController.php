<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Services\ProductService;
use App\Services\AttributeValueService;
use App\Services\CategoryService;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;
    protected $attributeValueService;
    protected $categoryService;
    public function __construct(ProductService $productService, AttributeValueService $attributeValueService, CategoryService $categoryService) {
        $this->productService = $productService;
        $this->attributeValueService = $attributeValueService;
        $this->categoryService = $categoryService;
    }
    //shop
    public function shop(){
        $categories = $this->categoryService->getAll();
        //dd($categories);
        return view('customer.shop', compact('categories'));
    }

    //get product by type
    public function getProductByType(Request $request)
    {
        $products = $this->productService->getProductByType($request->type);
        return response()->json($products);
    }

    //get product detail
    public function getProductDetail(Request $request)
    {
        $product = $this->productService->getProductBySlug($request->slug);
        return response()->json($product);
    }
    
    //get related product: get product by category
    public function getRelatedProduct($product_id)
    {
        $products = $this->productService->getRelatedProduct($product_id);
        return response()->json($products);
    }
    //get similar product: using TF-IDF
    public function getSimilarProduct($product_id)
    {
        $products = $this->productService->getSimilarProduct($product_id);
        return $products;
    }

    //get all attributes-values
    public function getAllAttributes(Request $request)
    {
        $attributes = [
            'data' => [
                'brand' => $this->attributeValueService->getAllValuesOfAttribute(7),
                'concentration' => $this->attributeValueService->getAllValuesOfAttribute(1),
                'style' => $this->attributeValueService->getAllValuesOfAttribute(2),
                'frag_group' => $this->attributeValueService->getAllValuesOfAttribute(3),
                'frag_time' => $this->attributeValueService->getAllValuesOfAttribute(4),
                'frag_distance' => $this->attributeValueService->getAllValuesOfAttribute(5),
                'age_group' => $this->attributeValueService->getAllValuesOfAttribute(8),
                'ingredients' => $this->attributeValueService->getAllValuesOfAttribute(9), // Giả sử ID 9 là ingredients
                'country' => $this->attributeValueService->getAllValuesOfAttribute(6),
            ]
        ];

        return response()->json($attributes, 200);
    }


    //get all products (shop page: pagination: gốc)
    public function getShop_Main(Request $request)
    {
        // Get all parameters from the request
        $filters = $request->all();
    
        $query = Product::with('productSizes');

        if (isset($filters['gender'])) {
            $gender = 2;
            switch ($filters['gender']) {
                case 'male':
                    $gender = 1;
                    break;
                case 'female':
                    $gender = 0;
                    break;
                case 'unisex':
                    $gender = 2;
                    break;
            }
            $query->where('gender', $gender);
        }

        if (isset($filters['concentration'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 1) 
                          ->where('id', $filters['concentration']);
                });
            });
        }
        if (isset($filters['style'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 2) 
                          ->where('id', $filters['style']);
                });
            });
        }
        if (isset($filters['frag_group'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 3) 
                          ->where('id', $filters['frag_group']);
                });
            });
        }
        if (isset($filters['frag_time'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 4) 
                          ->where('id', $filters['frag_time']);
                });
            });
        }
        if (isset($filters['frag_distance'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 5) 
                          ->where('id', $filters['frag_distance']);
                });
            });
        }
        if (isset($filters['country'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 6)
                          ->where('id', $filters['country']);
                });
            });
        }
        if (isset($filters['brand'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 7)
                          ->where('id', $filters['brand']);
                });
            });
        }
        if (isset($filters['age_group'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 8)
                          ->where('id', $filters['age_group']);
                });
            });
        }

        // Apply sorting based on 'field' and 'order' parameters
        $field = $request->get('field', 'price'); // Default to 'price' if no field
        $order = $request->get('order', 'asc');   // Default to 'asc' if no order 
        
        // Ensure only valid columns can be sorted to prevent SQL injection
        $allowedFields = ['price', 'name', 'trending'];
        if (in_array($field, $allowedFields)) {
            $query->orderBy($field, $order);
        }




        // Fetch and paginate results
        $products = $query->paginate(9);
    
        // Process and format the product data as needed
        $pro_list = $products->getCollection()->map(function ($product) {
            $imageArray = explode(',', $product->images);
            $firstImage = $imageArray[0] ?? ''; 
    
            $product_size_list = $product->productSizes->map(function ($size) {
                return [
                    'id' => $size->id,
                    'size' => $size->volume,
                    'price' => $size->price,
                    'discount' => $size->discount,
                ];
            });
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'images' => $firstImage,
                'slug' => $product->slug,
                'price' => $product_size_list->first()['price'],
                'discount' => $product_size_list->first()['discount'],
                'product_size_id' => $product_size_list->first()['id'],
                'size' => $product_size_list->first()['size'],
                'trending' => $product->trending,
            ];
        });
    
        // Return paginated data with metadata
        return response()->json([
            'data' => $pro_list,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'total_items' => $products->total(),
                'item_per_page' => $products->perPage(),
            ],
        ]);
    }

    //including search
    public function getShop1(Request $request)
    {
        // Get all parameters from the request
        $filters = $request->all();

        $content = $filters['search'];
        $product_ids = [30,41];
    
        $query = Product::with('productSizes');

        //Check xem filter search không
        if (isset($content)) {
            $query->whereIn('id', $product_ids);
        }        

        if (isset($filters['gender'])) {
            $gender = 2;
            switch ($filters['gender']) {
                case 'male':
                    $gender = 1;
                    break;
                case 'female':
                    $gender = 0;
                    break;
                case 'unisex':
                    $gender = 2;
                    break;
            }
            $query->where('gender', $gender);
        }

        if (isset($filters['concentration'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 1) 
                          ->where('id', $filters['concentration']);
                });
            });
        }
        if (isset($filters['style'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 2) 
                          ->where('id', $filters['style']);
                });
            });
        }
        if (isset($filters['frag_group'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 3) 
                          ->where('id', $filters['frag_group']);
                });
            });
        }
        if (isset($filters['frag_time'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 4) 
                          ->where('id', $filters['frag_time']);
                });
            });
        }
        if (isset($filters['frag_distance'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 5) 
                          ->where('id', $filters['frag_distance']);
                });
            });
        }
        if (isset($filters['country'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 6)
                          ->where('id', $filters['country']);
                });
            });
        }
        if (isset($filters['brand'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 7)
                          ->where('id', $filters['brand']);
                });
            });
        }
        if (isset($filters['age_group'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 8)
                          ->where('id', $filters['age_group']);
                });
            });
        }


        // Apply sorting based on 'field' and 'order' parameters
        $field = $request->get('field', 'price'); // Default to 'price' if no field
        $order = $request->get('order', 'asc');   // Default to 'asc' if no order 
        
        // Ensure only valid columns can be sorted to prevent SQL injection
        $allowedFields = ['price', 'name', 'trending'];
        if (in_array($field, $allowedFields)) {
            $query->orderBy($field, $order);
        }




        // Fetch and paginate results
        $products = $query->paginate(9);
    
        // Process and format the product data as needed
        $pro_list = $products->getCollection()->map(function ($product) {
            $imageArray = explode(',', $product->images);
            $firstImage = $imageArray[0] ?? ''; 
    
            $product_size_list = $product->productSizes->map(function ($size) {
                return [
                    'id' => $size->id,
                    'size' => $size->volume,
                    'price' => $size->price,
                    'discount' => $size->discount,
                ];
            });
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'images' => $firstImage,
                'slug' => $product->slug,
                'price' => $product_size_list->first()['price'],
                'discount' => $product_size_list->first()['discount'],
                'product_size_id' => $product_size_list->first()['id'],
                'size' => $product_size_list->first()['size'],
                'trending' => $product->trending,
            ];
        });
    
        // Return paginated data with metadata
        return response()->json([
            'data' => $pro_list,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'total_items' => $products->total(),
                'item_per_page' => $products->perPage(),
            ],
        ]);
    }

    //including collaberative filtering
    public function getShop(Request $request)
    {
        // Get all parameters from the request
        $filters = $request->all();

        
    
        $query = Product::with('productSizes');

        //check search theo nội dung
        if (isset($request->search)) {
            $filters['search'] = $request->search;
        
            $query->where('name', 'like', '%' . $filters['search'] . '%'); // Tìm kiếm theo tên sản phẩm
        }
        

        //check tag
        if (isset($filters['tag'])) {
            switch ($filters['tag']) {
                case 'all':
                    break;
                case 'for_you':
                    if (!isset(Auth::user()->id)) {
                        $query->where('trending', 1);
                        break;
                    }
                    $product_ids = $this->getCollaborativeFiltering2($request);
                    $query->whereIn('id', $product_ids);
                    break;
                default:
                    $query->where('category_id', $filters['tag']);
                    break;
            }
        }

        //check sort-by
        if (isset($filters['sort_by'])) {
            switch ($filters['sort_by']) {
                case 'lateness':
                    $query->orderBy('id', 'asc');
                    break;
                case 'newness':
                    $query->orderBy('id', 'desc');
                    break;
        }}
        $query->orderBy('id', 'desc');

        //Check xem filter search không
/*         if (isset($filters['search'])) {
            $query->whereIn('id', $product_ids);
        }    */     

        if (isset($filters['gender'])) {
            $gender = 2;
            switch ($filters['gender']) {
                case 'male':
                    $gender = 1;
                    break;
                case 'female':
                    $gender = 0;
                    break;
                case 'unisex':
                    $gender = 2;
                    break;
            }
            $query->where('gender', $gender);
        }

        //check price
        if (isset($filters['price_min'] ) && isset($filters['price_max'])) {
            $query->whereHas('productSizes', function ($query) use ($filters) {
                $query->where('price', '>=', $filters['price_min'])
                      ->where('price', '<=', $filters['price_max']);
            });
        }

        if (isset($filters['concentration'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 1) 
                          ->where('id', $filters['concentration']);
                });
            });
        }
        if (isset($filters['style'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 2) 
                          ->where('id', $filters['style']);
                });
            });
        }
        if (isset($filters['frag_group'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 3) 
                          ->where('id', $filters['frag_group']);
                });
            });
        }
        if (isset($filters['frag_time'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 4) 
                          ->where('id', $filters['frag_time']);
                });
            });
        }
        if (isset($filters['frag_distance'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 5) 
                          ->where('id', $filters['frag_distance']);
                });
            });
        }
        if (isset($filters['country'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 6)
                          ->where('id', $filters['country']);
                });
            });
        }
        if (isset($filters['brand'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 7)
                          ->where('id', $filters['brand']);
                });
            });
        }
        if (isset($filters['age_group'])) {
            $query->whereHas('productAttributes', function ($query) use ($filters) {
                $query->whereHas('attributeValue', function ($query) use ($filters) {
                    $query->where('attribute_id', 8)
                          ->where('id', $filters['age_group']);
                });
            });
        }


        // Apply sorting based on 'field' and 'order' parameters
        $field = $request->get('field', 'price'); // Default to 'price' if no field
        $order = $request->get('order', 'asc');   // Default to 'asc' if no order 
        
        // Ensure only valid columns can be sorted to prevent SQL injection
        $allowedFields = ['price', 'name', 'trending'];
        if (in_array($field, $allowedFields)) {
            $query->orderBy($field, $order);
        }


        // Fetch and paginate results
        $products = $query->paginate(9);
    
        // Process and format the product data as needed
        $pro_list = $products->getCollection()->map(function ($product) {
            $imageArray = explode(',', $product->images);
            $firstImage = $imageArray[0] ?? ''; 
    
            $product_size_list = $product->productSizes->map(function ($size) {
                return [
                    'id' => $size->id,
                    'size' => $size->volume,
                    'price' => $size->price,
                    'discount' => $size->discount,
                ];
            });
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'images' => $firstImage,
                'slug' => $product->slug,
                'price' => $product_size_list->first()['price'],
                'discount' => $product_size_list->first()['discount'],
                'product_size_id' => $product_size_list->first()['id'],
                'size' => $product_size_list->first()['size'],
                'trending' => $product->trending,
            ];
        });
    
        // Return paginated data with metadata
        return response()->json([
            'data' => $pro_list,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'total_items' => $products->total(),
                'item_per_page' => $products->perPage(),
            ],
        ]);
    }

    //collaborative filtering sử dụng lịch sử đánh giá
    public function getCollaborativeFiltering(Request $request){
        $productIds =  $this->productService->getCollaborativeFiltering($request);
        return $productIds;
    }

    //collaborative filtering sử dụng lịch sử mua hàng
    public function getCollaborativeFiltering2(Request $request){
        $productIds =  $this->productService->getCollaborativeFiltering2($request);
        return $productIds;
    }

    //Hàm lấy dữ liệu sản phẩm để gửi lên recommend_system_server
    public function getRecommendData()
    {
        return $this->productService->getRecommendData();
    }
    public function getRecommendData2()
    {
        return $this->productService->getRecommendData2();
    }

    public function getSimilarProduct_Ngrok(Request $request)
    {
        $product_id = $request->product_id;
        return $this->productService->getSimilarProduct_Ngrok($product_id);
    }
    public function getCollaborativeFiltering_Ngrok(Request $request)
    {
        return $this->productService->getCollaborativeFiltering_Ngrok($request);
    }

}
