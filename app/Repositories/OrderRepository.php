<?php 
namespace App\Repositories;

use App\Models\Order; 
use App\Models\OrderItem;
use App\Models\ProductSize;
use App\Models\Product;
use App\Contracts\Repositories\IBaseRepository;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements IBaseRepository
{
    protected $order;

    public function __construct(Order $order) // Use Order model here
    {
        parent::__construct($order);
        $this->order = $order;
    }
    public function getOrdersByStatus($status)
    {
        return $this->order->where('status', $status)->get();
    }
    public function getOrderDetail($order_id)
    {
        $order = $this->order->with('orderItems')->find($order_id);
        $order->address = json_decode($order->address);
        $order->log = json_decode($order->log);
        $order->order_items = $order->orderItems->map(function ($item) {
            $item->product_size_info = json_decode($item->product_size_info);
            return $item;
        });
        return $order;
        //return $this->order->with('orderItems')->find($order_id);
    }
    public function update($order_id, $data)
    {
        $order = $this->order->find($order_id);
        $order->status = $data['status'];
        $data_log_index = [
            0 => 'Chờ xử lý',
            1 => 'Đã xác nhận',
            2 => 'Đã hoàn thiện',
            3 => 'Chờ lấy hàng',
            4 => 'Đang giao hàng',
            5 => 'Đã giao hàng',
            6 => 'Đã hủy',
        ];
        // Lấy log cũ
        $log = json_decode($order->log);

        // Kiểm tra xem log đã được khởi tạo thành mảng chưa
        if (!is_array($log)) {
            //chuyển về log cũ về mảng
            $log = [$log];

            //$log = []; // Khởi tạo lại thành mảng nếu không phải
        }

        // Thêm log mới
        $log[] = date('Y-m-d H:i:s') . ' - ' . $data_log_index[$data['status']];
        $order->log = json_encode($log);
        $order->save();
        return $order;
    }

    public function createOrder($data)
    {
        $data['pre_value'] = $this->caculateTotal($data);
        $data['discount'] = $data['discount'] ?? 0;
        $data['value'] = $data['pre_value'] - $data['discount']* $data['pre_value'] / 100;


        $od = $this->order->create([
            'customer_id' => $data['customer_id'],

            /* value */
            'pre_value' => $data['pre_value'],
            'discount' => $data['discount'],
            'value' => $data['value'],

            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => json_encode($data['address']),
            'description' => $data['note'] ?? '',

            'order_date' => date('Y-m-d H:i:s'),
            'payment_status' => 0,
            'status' => $data['status'],
            'log' => json_encode([$data['status'] => date('Y-m-d H:i:s') . ' - Đặt thành công']),
            //'log' => json_encode(date('Y-m-d H:i:s') . ' - Đặt thành công'),

        ]);
        $order_id = $od->id;

        $items = $data['order_items'];
        foreach ($items as $item) {
            $product_size = ProductSize::find($item['product_size_id']);
            $product = Product::find($product_size->product_id);
            $orderItem = new OrderItem();
            $orderItem->order_id = $order_id;
            $orderItem->product_size_id = $item['product_size_id'];
            $orderItem->product_size_info = json_encode([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_size_id' => $product_size->id,
                'product_size_name' => $product_size->volume,
                'product_size_discount' => $product_size->discount,
                'product_size_price' => $product_size->price,
            ]);
            $orderItem->quantity = $item['quantity'];
            $orderItem->item_value = $product_size->price * $item['quantity'];
            $orderItem->save();
        }


        return $order_id;
    }

    public function caculateTotal($data)
    {
        $items = $data['order_items'];
        $pre_value = 0;
        foreach ($items as $item) {
            $product_size = ProductSize::find($item['product_size_id']);
            $pre_value += $product_size->price * $item['quantity'];
        }
        return $pre_value;

    }



    public function getOrderByUser1($user_id, $status)
    {
        $sql = "
        SELECT 
            od.id AS order_id, 
            od.status, 
            GROUP_CONCAT(pd.images) AS images, 
            GROUP_CONCAT(o_i.product_size_info) AS product_size_info 
        FROM 
            orders AS od
        JOIN 
            order_items o_i ON o_i.order_id = od.id
        JOIN 
            product_sizes ps ON ps.product_id = o_i.product_size_id
        JOIN 
            products pd ON pd.id = ps.product_id
        WHERE 
            od.status = 1 AND od.customer_id = 5
        GROUP BY 
            od.id, od.status;
            ";

    
        $orders = DB::select($sql);
    
        return $orders;
    }
    public function getOrderByUser($user_id, $status)
    {
        if ($status == 2) $status = 3;
        
        $sql = "
        SELECT 
            od.id AS order_id, 
            od.status, 
            od.value,
            GROUP_CONCAT(pd.images) AS images, 
            GROUP_CONCAT(o_i.product_size_info) AS product_size_info 
        FROM 
            orders AS od
        JOIN 
            order_items o_i ON o_i.order_id = od.id
        JOIN 
            product_sizes ps ON ps.product_id = o_i.product_size_id
        JOIN 
            products pd ON pd.id = ps.product_id
        WHERE 
            od.status = ? AND od.customer_id = ?
        GROUP BY 
            od.id, od.status;
        ";
    
        $orders = DB::select($sql, [$status, $user_id]);
    
        foreach ($orders as $order) {
            // Chia tách các chuỗi JSON thành một mảng
            $productSizeInfos = explode('},{', trim($order->product_size_info, '{}'));
    
            // Chuyển đổi từng phần tử thành mảng và lấy ảnh đại diện
            $order->product_size_info = array_map(function($item) {
                return json_decode('{' . $item . '}', true);
            }, $productSizeInfos);
    
            // Lấy ảnh đại diện cho từng sản phẩm
            foreach ($order->product_size_info as &$product) {
                $productId = $product['product_id'];
    
                // Truy vấn ảnh từ bảng products (lấy ảnh đầu tiên)
                $imageSql = "SELECT images FROM products WHERE id = ?";
                $image = DB::select($imageSql, [$productId]);
    
                // Gán ảnh đại diện (nếu có)
                $product['image'] = $image ? explode(',', $image[0]->images)[0] : null; // Lấy ảnh đầu tiên
            }
        }
    
        return $orders;
    }
    
    
    

    
    
}
