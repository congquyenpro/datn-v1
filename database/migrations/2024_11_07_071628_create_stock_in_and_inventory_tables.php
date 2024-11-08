
<?php  
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInAndInventoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tạo bảng stock_in
        Schema::create('stock_in', function (Blueprint $table) {
            $table->id();  // Khóa chính tự động tăng với tên là 'id'
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Khóa ngoại liên kết với bảng `products`
            //$table->foreignId('warehouse_id')->constrained()->onDelete('cascade');  // Khóa ngoại liên kết với bảng `warehouses`
            $table->integer('quantity');  // Số lượng nhập kho
            $table->timestamp('stock_in_date');  // Ngày nhập kho
            $table->timestamp('expiry_date')->nullable();  // Ngày hết hạn (có thể null)
            $table->timestamps();  // Các cột created_at và updated_at
        });

        // Tạo bảng inventory
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();  // Khóa chính tự động tăng với tên là 'id'
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Khóa ngoại liên kết với bảng `products`
            //$table->foreignId('warehouse_id')->constrained()->onDelete('cascade');  // Khóa ngoại liên kết với bảng `warehouses`
            $table->integer('quantity');  // Số lượng tồn kho
            $table->timestamp('last_updated');  // Thời gian cập nhật tồn kho
            $table->timestamp('expiry_date')->nullable();  // Ngày hết hạn (có thể null)
            $table->timestamps();  // Các cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Xóa bảng inventory và stock_in
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('stock_in');
    }
}
