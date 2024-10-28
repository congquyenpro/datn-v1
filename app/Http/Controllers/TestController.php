<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Product;

class TestController extends Controller
{

    //Test pagination
    public function test()
    {
        // Lấy sản phẩm với phân trang
        $products = Product::paginate(5); // Lấy 5 sản phẩm mỗi trang
    
        // Trả về dữ liệu JSON với thông tin phân trang
        return response()->json([
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'total' => $products->total(),
            'per_page' => $products->perPage(),
            'data' => $products->items(), // Trả về sản phẩm gốc mà không cần định dạng
        ]);

        //return view('test', compact('products'));
    }
    
    
    
}
