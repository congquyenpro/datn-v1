<?php 
namespace App\Repositories;

use App\Models\Order; 
use App\Models\OrderItem;
use App\Models\ProductSize;
use App\Models\Product;
use App\Contracts\Repositories\IBaseRepository;
use Illuminate\Support\Facades\DB;

class OrderRepository_Main extends BaseRepository implements IBaseRepository
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

        //Kiểm tra $data['shipping_partner'] có tồn tại không
        if (isset($data['shipping_partner'])) {
            if ($data['shipping_partner'] == 3){
                $order->delivery_company_code = $data['other_partner_name'];
                $order->shipping_code = $data['other_partner_code'];
                $order->shipping_cost = $data['other_partner_fee'];
            }
        }

        //Kiểm tra nếu $data['status'] == 1 thì thực hiện trừ số lượng sản phẩm theo order_items
        if ($data['status'] == 1) {
            $this->minusProductQuantity($order_id);
        }


        $order->status = $data['status'];
        $data_log_index = [
            0 => 'Chờ xử lý',
            1 => 'Đã xác nhận',
            2 => 'Đã hoàn thiện',
            3 => 'Chờ lấy hàng',
            4 => 'Đang giao hàng',
            5 => 'Đã giao hàng',
            6 => 'Đã hủy',
            7 => 'Hoàn trả',
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

    //Hàm trừ sản phẩm sau khi đã xác nhận
    public function minusProductQuantity($order_id)
    {
        $order = $this->order->find($order_id);
        $order_items = $order->orderItems;
        foreach ($order_items as $item) {
            $product_size = ProductSize::find($item->product_size_id);
            $product_size->quantity -= $item->quantity;
            //Trừ cả số lượng kho
            $product_size->inventory_quantity -= $item->quantity;
            $product_size->save();
        }
        //return $order_items;
    }


    /* Customer */
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
            'payment_method' => $data['payment_method'],
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
            //lấy ra ảnh đầu tiên của product
            $product_images = explode(',', $product->images);
            

            $orderItem->product_size_info = json_encode([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_size_id' => $product_size->id,
                'product_size_name' => $product_size->volume,
                'product_size_discount' => $product_size->discount,
                'product_size_price' => $product_size->price,
                'product_entry_price' => $product_size->entry_price,
                'product_image' => $product_images[0],
            ]);
            $orderItem->quantity = $item['quantity'];
            $orderItem->item_value = $product_size->price * $item['quantity'];
            $orderItem->entry_price = $product_size->entry_price * $item['quantity'];
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
    public function getOrderByUser_Main($user_id, $status)
    {
        if ($status == 3) $status = 2;
        
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

    public function getOrderByUser($user_id, $status)
    {
        //if ($status == 3) $status = 2;
    
        $sql = "
            SELECT 
                o.id AS order_id,
                o.value,
                o.status,
                GROUP_CONCAT(p.images) AS images,
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'product_id', ps.product_id,
                        'product_name', p.name,
                        'product_size_id', ps.id,
                        'product_size_name', ps.volume,
                        'product_size_price', oi.item_value,
                        'product_size_discount', ps.discount,
                        'image', p.images
                    )
                ) AS product_size_info
            FROM 
                Orders o
            JOIN 
                Order_Items oi ON oi.order_id = o.id
            JOIN 
                Product_Sizes ps ON ps.id = oi.product_size_id
            JOIN 
                Products p ON p.id = ps.product_id
            WHERE 
                o.customer_id = ? AND o.status = ?
            GROUP BY 
                o.id, o.value, o.status
            ORDER BY 
                o.order_date DESC;
            
        ";
    
        $orders = DB::select($sql, [$user_id, $status]);
        foreach ($orders as $order) {
            // Chia tách các chuỗi JSON thành một mảng
            $productSizeInfos = json_decode($order->product_size_info, true);
            $order->product_size_info = $productSizeInfos;
    
            // Tách chuỗi hình ảnh và gán vào thuộc tính images
            $order->images = explode(',', $order->images);
    
            // Lấy ảnh đại diện cho từng sản phẩm
            foreach ($order->product_size_info as &$product) {
                $productId = $product['product_id'];
    
                // Truy vấn ảnh từ bảng products (lấy ảnh đầu tiên)
                $imageSql = "SELECT images FROM products WHERE id = ?";
                $image = DB::select($imageSql, [$productId]);

                //Truy vấn lấy ra quantity của item
                $quantitySql = "SELECT quantity FROM order_items WHERE order_id = ? AND product_size_id = ?";
                $quantity = DB::select($quantitySql, [$order->order_id, $product['product_size_id']]);
    
                // Gán ảnh đại diện (nếu có)
                $product['image'] = $image ? explode(',', $image[0]->images)[0] : null; // Lấy ảnh đầu tiên

                // Gán số lượng sản phẩm
                $product['quantity'] = $quantity[0]->quantity;
            }
        }
    
        return $orders;
    }
    public function getOrderByUser3($user_id, $status)
    {
        //if ($status == 3) $status = 2;
    
        $sql = "
            SELECT 
                o.id AS order_id,
                o.value,
                o.status,
                GROUP_CONCAT(p.images) AS images,
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'product_id', ps.product_id,
                        'product_name', p.name,
                        'product_size_id', ps.id,
                        'product_size_name', ps.volume,
                        'product_size_price', ps.price,
                        'product_size_discount', ps.discount,
                        'image', p.images
                    )
                ) AS product_size_info
            FROM 
                Orders o
            JOIN 
                Order_Items oi ON oi.order_id = o.id
            JOIN 
                Product_Sizes ps ON ps.id = oi.product_size_id
            JOIN 
                Products p ON p.id = ps.product_id
            WHERE 
                o.customer_id = ? AND o.status = ?
            GROUP BY 
                o.id, o.value, o.status
            ORDER BY 
                o.order_date DESC;
            
        ";
    
        $orders = DB::select($sql, [$user_id, $status]);
        foreach ($orders as $order) {
            // Chia tách các chuỗi JSON thành một mảng
            $productSizeInfos = json_decode($order->product_size_info, true);
            $order->product_size_info = $productSizeInfos;
    
            // Tách chuỗi hình ảnh và gán vào thuộc tính images
            $order->images = explode(',', $order->images);
    
            // Lấy ảnh đại diện cho từng sản phẩm
            foreach ($order->product_size_info as &$product) {
                $productId = $product['product_id'];
    
                // Truy vấn ảnh từ bảng products (lấy ảnh đầu tiên)
                $imageSql = "SELECT images FROM products WHERE id = ?";
                $image = DB::select($imageSql, [$productId]);

                //Truy vấn lấy ra quantity của item
                $quantitySql = "SELECT quantity FROM order_items WHERE order_id = ? AND product_size_id = ?";
                $quantity = DB::select($quantitySql, [$order->order_id, $product['product_size_id']]);
    
                // Gán ảnh đại diện (nếu có)
                $product['image'] = $image ? explode(',', $image[0]->images)[0] : null; // Lấy ảnh đầu tiên

                // Gán số lượng sản phẩm
                $product['quantity'] = $quantity[0]->quantity;
            }
        }
    
        return $orders;
    }
    public function getOrderByUser2($user_id, $status)
    {
        $sql = "
            SELECT 
                od.id, 
                orders.id AS order_id, 
                orders.status, 
                products.name AS product_name,
                SUBSTRING_INDEX(products.images, ',', 1) AS image,  -- Lấy ảnh đầu tiên
                od.product_size_id, 
                ps.volume AS product_size_name, 
                ps.price AS product_size_price,
                ps.discount AS product_size_discount,
                od.quantity, 
                od.item_value
            FROM order_items AS od
            JOIN orders ON od.order_id = orders.id
            JOIN product_sizes AS ps ON od.product_size_id = ps.id
            JOIN products ON ps.product_id = products.id
            WHERE 
                orders.customer_id = ? 
                AND orders.status = ?
            ORDER BY orders.order_date DESC;
        ";
    
        // Thực thi truy vấn với các tham số
        $orders = DB::select($sql, [$user_id, $status]);
    
        // Nhóm các sản phẩm theo order_id
        $groupedOrders = [];
        foreach ($orders as $order) {
            // Nếu order_id chưa có trong mảng $groupedOrders, tạo mới
            if (!isset($groupedOrders[$order->order_id])) {
                $groupedOrders[$order->order_id] = [
                    'order_id' => $order->order_id,
                    'status' => $order->status,
                    'images' => [$order->image],  // Mảng chứa các ảnh (nếu có)
                    'product_size_info' => []
                ];
            }
    
            // Lấy thông tin sản phẩm và thêm vào mảng product_size_info
            $product = [
                'product_id' => $order->id,  // ID của product_size trong order_items
                'product_name' => $order->product_name,
                'product_size_id' => $order->product_size_id,
                'product_size_name' => $order->product_size_name,
                'product_size_price' => $order->product_size_price,
                'product_size_discount' => $order->product_size_discount,
                'image' => $order->image,
                'quantity' => $order->quantity,
                'item_value' => $order->item_value
            ];
    
            // Thêm sản phẩm vào mảng product_size_info của đơn hàng
            $groupedOrders[$order->order_id]['product_size_info'][] = $product;
    
            // Thêm ảnh sản phẩm vào mảng images (nếu chưa có ảnh giống)
            if (!in_array($order->image, $groupedOrders[$order->order_id]['images'])) {
                $groupedOrders[$order->order_id]['images'][] = $order->image;
            }
        }
    
        // Chuyển kết quả thành mảng và trả về
        return array_values($groupedOrders);
    }
    

    
    
}
