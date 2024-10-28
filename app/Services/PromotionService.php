<?php 

namespace App\Services;

use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;


class PromotionService
{
    public function getAll(){
        return Promotion::all();
    }

    public function getById($id){
        return Promotion::find($id);
    }

    public function showProductList($product_list) {
        // Chuyển chuỗi thành mảng = bỏ dấu ngoặc vuông và dấu nháy
        $productIds = json_decode($product_list);
        
        //get list
        return Product::whereIn('id', $productIds)->get(['id', 'name']);
    }
    

    public function getProductList() {
        // Lấy danh sách sản phẩm chỉ với id và name
        $products = Product::select(['id', 'name'])->get();
        return $products;
    }



    public function create($data){
        try {
            Promotion::create($data);
            return back()->with('success', 'Thêm khuyến mãi thành công');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage(),
            ]);
        }
    }

    public function update($id, $data){
        $promotion = Promotion::find($id);
        $promotion->update($data);
        return $promotion;
    }

    public function delete($id){
        $promotion = Promotion::find($id);
        $promotion->delete();
    }


    //Home page
    public function getDealOfDay() {
        // Lấy ra ngày hiện tại với định dạng ngày-tháng-năm
        $currentDate = Carbon::now()->format('d/m/Y');
    
        // Lấy chương trình khuyến mãi mới nhất mà có end_date > current_date
        $promotion = Promotion::whereRaw("STR_TO_DATE(end_date, '%d/%m/%Y') > STR_TO_DATE(?, '%d/%m/%Y')", [$currentDate])
            ->orderBy('end_date', 'asc') // Sắp xếp theo end_date
            ->first(); // Lấy chương trình khuyến mãi mới nhất
    
        // Khởi tạo một mảng để lưu các sản phẩm
        $products = collect();
    
        // Kiểm tra xem chương trình khuyến mãi có tồn tại không
        if ($promotion) {
            $productIds = json_decode($promotion->product_list);
    
            // Kiểm tra xem productIds có hợp lệ không
            if ($productIds && is_array($productIds)) {
                $products = Product::whereIn('id', $productIds)
                    ->with('productSizes') // Tải trước mối quan hệ productSizes
                    ->get()
                    ->map(function ($product) use ($promotion) { // Sử dụng promotion để lấy end_date
                        // Xử lý các thuộc tính của sản phẩm
                        if ($product->productSizes->isNotEmpty()) {
                            $firstSize = $product->productSizes->first();
                            $product->product_id = $product->id;
                            $product->product_name = $product->name;
                            $product->price = $firstSize->price; 
                            $product->product_size_id = $firstSize->id; 
                            $product->size = $firstSize->volume; 
                            $product->discount = $firstSize->discount;
                        }
                        $imagesArray = explode(',', $product->images);
                        $product->image = trim($imagesArray[0]);
                        
                        // Thêm end_date vào sản phẩm
                        $product->end_date = $promotion->end_date.' 23:59:59';
    
                        return $product->only(['product_id', 'slug', 'product_name', 'product_size_id', 'size', 'image', 'price', 'discount', 'end_date']);
                    });
            }
        }
    
        return response()->json($products);
    }
    

}