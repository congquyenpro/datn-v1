<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Repositories\ProductRepository;

class TestController extends Controller
{

    protected $productRepository;
    //Test pagination
    public function test1()
    {
        // Lấy sản phẩm với phân trang
        $products = Product::with('productSizes')->paginate(9);

        $pro_list = $products->getCollection()->map(function ($product) {
            $imageArray = explode(',', $product->images);
            $firstImage = $imageArray[0] ?? ''; // Check if there is at least 1 image
            $product_size_list =  $product->productSizes->map(function ($size) {
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
                'images' => $firstImage, // Assume images is a URL or path
                'price' => $product_size_list->first()['price'], // Get the first size's price
                'discount' => $product_size_list->first()['discount'],
                'product_size_id' => $product_size_list->first()['id'],
                'size' => $product_size_list->first()['size'],
                'trending' => $product->trending, // Or 1/0 depending on your logic
            ];
        });
        
        // Return paginated data along with the pagination metadata
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

    public function test(Request $request)
    {
        // Get all parameters from the request
        $filters = $request->all();
    
        $query = Product::with('productSizes');

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
    
    

    
    
    
}
