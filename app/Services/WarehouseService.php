<?php 
namespace App\Services;
use App\Models\Product;
use App\Models\ProductSize;
use DB;
use Illuminate\Http\Request;

class WarehouseService {
    public function getProducts() {
        return Product::get(['id', 'name', 'price']);
    }
    public function getProductSizes($product_id) {
        return ProductSize::where('product_id', $product_id)->get();
    }

    public function store(Request $request)
    {
        //return response()->json($request->all);
        // Xác thực dữ liệu gửi lên
        $data = $request->validate([
            'type' => 'required|in:IN,OUT',  // Kiểm tra loại phiếu nhập (IN hoặc OUT)
            'entries' => 'required|array',  // entries là mảng chứa thông tin các phiếu nhập
            'entries.*.productId' => 'required|integer',
            'entries.*.sizeId' => 'required|integer',
            'entries.*.quantity' => 'required|integer|min:1',
            'entries.*.entryPrice' => 'required|numeric|min:0',
            'entries.*.expiryDate' => 'required|date',  // Kiểm tra ngày hết hạn
        ]);
        $admin_id = auth()->user()->id; // Lấy ID của admin đang đăng nhập
    
        $totalValue = 0;  // Khởi tạo biến tổng giá trị cho phiếu nhập
        $ticketId = null; // Khai báo biến ticketId để lưu giá trị sau khi tạo phiếu nhập kho
    
        // Đầu tiên tính tổng giá trị của tất cả các mục nhập
        foreach ($request->entries as $entry) {
            // Lấy thông tin từ mỗi mục nhập kho
            $quantity = $entry['quantity'];
            $entryPrice = $entry['entryPrice'];
    
            // Tính giá trị của sản phẩm nhập kho (quantity * entryPrice) và cộng vào tổng giá trị phiếu nhập
            $totalValue += $quantity * $entryPrice;
        }
    
        // Tạo phiếu nhập kho (inventory_changes) chỉ một lần, sau khi đã tính tổng giá trị
        $ticketId = DB::table('inventory_changes')->insertGetId([
            'value' => $totalValue,              // Giá trị của phiếu nhập (tổng giá trị của tất cả các mục)
            'type' =>  $request->type,                   // Loại phiếu nhập (IN)
            'admin_id' => $admin_id,              // ID của admin thực hiện
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Sau khi đã có $ticketId, lưu thông tin vào bảng Stock_Entries cho từng sản phẩm nhập kho
        foreach ($request->entries as $entry) {
            $sizeId = $entry['sizeId'];
            $quantity = $entry['quantity'];
            $entryPrice = $entry['entryPrice'];
            $expiryDate = $entry['expiryDate'];
            $damage_reason = $entry['damaged'] ?? ''; //Lý do nếu hàng hỏng
    
            // Lưu thông tin vào bảng Stock_Entries cho từng sản phẩm nhập kho
            DB::table('stock_entries')->insert([
                'inventory_changes_id' => $ticketId,   // Lưu inventory_changes_id từ $ticketId
                'product_size_id' => $sizeId,          // ID của kích thước sản phẩm
                'product_name' => 'Product Name',      // Tên sản phẩm (nếu có tên thật thì thay thế)
                'entry_date' => now(),                 // Ngày nhập
                'quantity' => $quantity,               // Số lượng nhập
                'entry_price' => $entryPrice,          // Giá nhập
                'supplier_name' => '',                 // Tên nhà cung cấp (optional)
                'expiry_date' => $expiryDate,          // Ngày hết hạn (optional)
                'damaged_reason' => $damage_reason,                   // Lý do hàng hỏng (optional)
                'created_at' => now(),                 // Thời gian tạo
                'updated_at' => now(),                 // Thời gian cập nhật
            ]);

            //Cập nhật entry_price trong bảng product_sizes
            if ($request->type == "IN") {
                $product_size = ProductSize::find($sizeId);
                $product_size->entry_price = $entryPrice;
                $product_size->save();
            }

        }

        //Thực hiện cộng hoặc trừ sản phẩm
        if($request->type == 'IN'){
            //Cộng: Chỉ cộng vào cột số lượng trong kho
            $this->plusProductQuantity($ticketId);
        }else{
            //Trừ: trừ 2 cột số lượng trong kho và số lượng có thể bán
            $this->minusProductQuantity($ticketId);
        }
    
        // Trả về phản hồi với tổng giá trị đã tính
        return response()->json([
            'status' => 200,
            'message' => 'Phiếu nhập hàng đã được lưu thành công.',
            'total_value' => $totalValue,  // Tổng giá trị các sản phẩm nhập kho
        ], 200);
    }


    public function minusProductQuantity($inventory_changes_id)
    {
        //Trừ đi cột inventory_quantity và quantity trong product_sizes
        $stock_entries = DB::table('stock_entries')->where('inventory_changes_id', $inventory_changes_id)->get();
        foreach ($stock_entries as $entry) {
            $product_size = ProductSize::find($entry->product_size_id);
            $product_size->inventory_quantity -= $entry->quantity;
            $product_size->quantity -= $entry->quantity;
            $product_size->save();
        }
    }

    public function plusProductQuantity($inventory_changes_id)
    {
        //Cộng vào cột inventory_quantity trong product_sizes
        $stock_entries = DB::table('stock_entries')->where('inventory_changes_id', $inventory_changes_id)->get();
        foreach ($stock_entries as $entry) {
            $product_size = ProductSize::find($entry->product_size_id);
            $product_size->inventory_quantity += $entry->quantity;
            $product_size->save();
        }

    }
    
    public function getInventoryChanges(){
        return DB::table('inventory_changes')->get();
    }
    public function getInventoryChangeDetails($ticketId){
        return DB::table('inventory_changes')->where('id', $ticketId)->get();
    }
    public function getChangeDetails($ticketId){
        return DB::table('stock_entries')->where('inventory_changes_id', $ticketId)->get();
    }
}