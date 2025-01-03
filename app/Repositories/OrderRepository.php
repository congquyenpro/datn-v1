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
    public function getOrdersByStatus($status, $order_timeframe)
    {
        //return $this->order->where('status', $status)->get();

        /* Có cả month */
        // Giả sử $timeframe là tham số được truyền vào để xác định khoảng thời gian (ví dụ: 'current_month', 'last_3_months', 'all')
        $timeframe = $order_timeframe; // Thay thế với giá trị thực tế mà bạn muốn

        $query = $this->order->where('status', $status);

        switch ($timeframe) {
            case 'current_month':
                // Lọc theo tháng hiện tại
                $query->whereBetween('order_date', [
                    now()->startOfMonth(), 
                    now()->endOfMonth()
                ]);
                break;

            case 'last_3_months':
                // Lọc theo 3 tháng gần đây
                $query->whereBetween('order_date', [
                    now()->subMonths(3), 
                    now()->endOfMonth()
                ]);
                break;

            case 'all_months':
                // Không có điều kiện về order_date
                // Thực hiện truy vấn mặc định
                break;
        }

        return $query->get();

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

    //count order
    public function countOrder($order_status)
    {
        // Các trạng thái cần kiểm tra (từ 0 đến 7)
        $statuses = [0, 1, 2, 3, 4, 5, 6, 7];
    
        // Nếu có filter theo trạng thái
        if ($order_status) {
            // Đếm số lượng đơn hàng cho trạng thái cụ thể
            $counts = Order::where('status', $order_status)
                           ->select('status', \DB::raw('count(*) as count'))
                           ->groupBy('status')
                           ->get();
            
            // Nếu không có đơn hàng cho trạng thái đó, trả về count = 0
            if ($counts->isEmpty()) {
                return response()->json([
                    'status' => $order_status,
                    'count' => 0
                ]);
            }
        } else {
            // Nếu không có filter theo trạng thái, trả về số lượng đơn hàng cho tất cả các trạng thái
            $counts = collect();  // Sử dụng collection để chứa kết quả
    
            foreach ($statuses as $status) {
                // Đếm số lượng đơn hàng cho mỗi trạng thái
                $count = Order::where('status', $status)->count();
                
                // Thêm kết quả vào collection
                $counts->push([
                    'status' => $status,
                    'count' => $count
                ]);
            }
        }
    
        return $counts;
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

        //Nếu trạng thái order = 5 tức đã hoàn thành => chuyển payment_status = 1
        if ($data['status'] == 5) {
            $order->payment_status = 1;
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

    //Quản lý order của người dùng
    public function getCustomerOrderList($customer_type)
    {
        // Lấy ra khách hàng hệ thống - đã có tài khoản
        if ($customer_type =='system') {
            $order_user_list = $this->order
            ->join('users AS u', 'u.id', '=', 'orders.customer_id')  // INNER JOIN
            ->select('orders.customer_id', 'orders.name', 'u.status', DB::raw('SUM(orders.value) AS tong_chi_tieu'))
            ->groupBy('orders.customer_id', 'orders.name', 'u.status')
            ->where('orders.customer_id', '!=', 3)  // Lọc theo trạng thái hoạt động
            ->get();  // Lấy kết quả
        }
        else {
            $order_user_list = $this->order
            ->join('users AS u', 'u.id', '=', 'orders.customer_id')  // INNER JOIN
            ->select('orders.customer_id', 'orders.name', 'u.status', DB::raw('SUM(orders.value) AS tong_chi_tieu'))
            ->groupBy('orders.customer_id', 'orders.name', 'u.status')
            ->where('orders.customer_id', 3)  // Lọc theo trạng thái hoạt động
            ->get();  // Lấy kết quả
        }
        return $order_user_list;
    }
    public function getCustomerDetail($customer_id)
    {
        $order_user_detail = $this->order
        ->join('users AS u', 'u.id', '=', 'orders.customer_id')  // INNER JOIN
        ->select('orders.customer_id', 'orders.name','u.address', 'u.email', 'u.status', DB::raw('SUM(orders.value) AS tong_chi_tieu'))
        ->groupBy('orders.customer_id', 'orders.name', 'u.status','u.address', 'u.email')
        ->where('orders.customer_id', $customer_id)  // Lọc theo trạng thái hoạt động
        ->get();  // Lấy kết quả
        return $order_user_detail;
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

    public function getOrderByUser_7_12($user_id, $status)
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

    //Lấy Order theo status
    public function getOrderByUser($user_id, $status)
    {
        if ($status == 3) {
            $sql = "
            SELECT 
            o.id AS order_id,
            o.value,
            o.status,
            GROUP_CONCAT(p.images) AS images,
            ps.product_id,
            p.name AS product_name,
            ps.id AS product_size_id,
            ps.volume AS product_size_name,
            MAX(oi.item_value) AS product_size_price, -- Sử dụng MAX hoặc các hàm tổng hợp khác
            MAX(ps.discount) AS product_size_discount, -- Hàm tổng hợp
            p.images AS product_image
            FROM 
                orders o
            JOIN 
                order_items oi ON oi.order_id = o.id
            JOIN 
                product_sizes ps ON ps.id = oi.product_size_id
            JOIN 
                products p ON p.id = ps.product_id
            WHERE 
                o.customer_id = ? AND (o.status = 3 OR o.status = 2)
            GROUP BY 
                o.id, o.value, o.status, ps.product_id, ps.id, p.images, p.name, ps.volume
            ORDER BY 
                o.order_date DESC;    
            ";
        }elseif ($status == 7 || $status == 6) {
            $sql = "
            SELECT 
            o.id AS order_id,
            o.value,
            o.status,
            GROUP_CONCAT(p.images) AS images,
            ps.product_id,
            p.name AS product_name,
            ps.id AS product_size_id,
            ps.volume AS product_size_name,
            MAX(oi.item_value) AS product_size_price, -- Sử dụng MAX hoặc các hàm tổng hợp khác
            MAX(ps.discount) AS product_size_discount, -- Hàm tổng hợp
            p.images AS product_image
            FROM 
                orders o
            JOIN 
                order_Items oi ON oi.order_id = o.id
            JOIN 
                product_Sizes ps ON ps.id = oi.product_size_id
            JOIN 
                products p ON p.id = ps.product_id
            WHERE 
            o.customer_id = ? AND (o.status = 6 OR o.status = 7)
            GROUP BY 
                o.id, o.value, o.status, ps.product_id, ps.id, p.images, p.name, ps.volume
            ORDER BY 
                o.order_date DESC;    
            ";
        }
        else{
            $sql = "
            SELECT 
            o.id AS order_id,
            o.value,
            o.status,
            GROUP_CONCAT(p.images) AS images,
            ps.product_id,
            p.name AS product_name,
            ps.id AS product_size_id,
            ps.volume AS product_size_name,
            MAX(oi.item_value) AS product_size_price, -- Sử dụng MAX hoặc các hàm tổng hợp khác
            MAX(ps.discount) AS product_size_discount, -- Hàm tổng hợp
            p.images AS product_image
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
                o.id, o.value, o.status, ps.product_id, ps.id, p.images, p.name, ps.volume
            ORDER BY 
                o.order_date DESC;    
            ";
        }


    
        $orders = DB::select($sql, [$user_id, $status]);

        // Chuẩn bị dữ liệu
        $orderData = [];
        foreach ($orders as $order) {
            $orderId = $order->order_id;
        
            // Khởi tạo nếu chưa tồn tại đơn hàng trong danh sách
            if (!isset($orderData[$orderId])) {
                $orderData[$orderId] = [
                    'order_id' => $order->order_id,
                    'value' => $order->value,
                    'status' => $order->status,
                    'images' => explode(',', $order->images),
                    'product_size_info' => []
                ];
            }
        
            // Thêm sản phẩm vào danh sách
            $orderData[$orderId]['product_size_info'][] = [
                'product_id' => $order->product_id,
                'product_name' => $order->product_name,
                'product_size_id' => $order->product_size_id,
                'product_size_name' => $order->product_size_name,
                'product_size_price' => $order->product_size_price,
                'product_size_discount' => $order->product_size_discount,
                'image' => explode(',', $order->product_image)[0] ?? null // Lấy ảnh đầu tiên
            ];
        }
        
        // Định dạng kết quả
        $finalOrders = array_values($orderData); // Chuyển từ key-value sang mảng chỉ số
        return $finalOrders;
        
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

    //Lấy tất cả order của user
    public function getUserOrderDetail($customer_id){
        $orders = $this->order->where('customer_id', $customer_id)->get();
        return $orders;
    }
    
    
    
    

    
    
}
