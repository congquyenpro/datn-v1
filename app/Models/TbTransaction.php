<?php

// app/Models/TbTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbTransaction extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng trong database
    protected $table = 'tb_transactions';

    // Đặt primary key nếu không phải là 'id'
    protected $primaryKey = 'id';

    // Tắt tự động cập nhật timestamps nếu không dùng (Nếu dùng thì không cần)
    public $timestamps = true;

    // Đặt các thuộc tính có thể được gán hàng loạt (mass assignable)
    protected $fillable = [
        'gateway',
        'transaction_date',
        'account_number',
        'sub_account',
        'amount_in',
        'amount_out',
        'accumulated',
        'code',
        'transaction_content',
        'reference_number',
        'body',
    ];

    // Đặt các thuộc tính không thể được gán hàng loạt (mass assignable)
    protected $guarded = [];

    // Đặt kiểu dữ liệu cho các trường cần format đặc biệt (nếu có)
    protected $casts = [
        'transaction_date' => 'datetime',  // Đảm bảo trường transaction_date là kiểu datetime
        'amount_in' => 'decimal:2',  // Đảm bảo amount_in có 2 chữ số sau dấu thập phân
        'amount_out' => 'decimal:2',  // Đảm bảo amount_out có 2 chữ số sau dấu thập phân
        'accumulated' => 'decimal:2',  // Đảm bảo accumulated có 2 chữ số sau dấu thập phân
    ];

    // Bạn cũng có thể tạo các mối quan hệ Eloquent trong model nếu có liên kết với các bảng khác
}
