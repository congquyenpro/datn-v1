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
            'note' => $data['description'] ?? '',

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
                'product_size_name' => $product_size->size,
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
