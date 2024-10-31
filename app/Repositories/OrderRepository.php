<?php 
namespace App\Repositories;

use App\Models\Order; 
use App\Models\OrderItem;
use App\Models\ProductSize;
use App\Models\Product;
use App\Contracts\Repositories\IBaseRepository;

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
            $log = []; // Khởi tạo lại thành mảng nếu không phải
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
            'log' => json_encode(date('Y-m-d H:i:s') . ' - Đặt thành công'),

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
}
