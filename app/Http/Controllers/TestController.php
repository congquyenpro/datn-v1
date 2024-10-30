<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Repositories\ProductRepository;

class TestController extends Controller
{

    protected $productRepository;
    //Test pagination
    public function test()
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
    
    
    
}
