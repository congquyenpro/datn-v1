<?php 
namespace App\Services;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

class ShippingService {
    private $token = 'a26e2748-971a-11ee-b1d4-92b443b7a897';
    private $shopId = '190517';

    //Tính phí dịch vụ trước khi Tạo đơn
    public function calculateFee($data) {
        $response = Http::withHeaders([
            'Token' => $this->token,
            'Content-Type' => 'application/json',
            'ShopId' => $this->shopId
        ])->withOptions([
            'verify' => false, // Tắt xác thực SSL
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', $data);
    
        if ($response->successful()) {
            return $response->json();
        } else {
            // Xử lý lỗi
            return $response->json();
        }
    }
    
    public function createShippingOrder($data) {
/*         $data1 = [
            'payment_type_id' => 2,
            'note' => 'Tintest 123',
            'required_note' => 'KHONGCHOXEMHANG',
            'return_phone' => '0332190158',
            'return_address' => '39 NTT',
            'return_district_id' => null,
            'return_ward_code' => '',
            'client_order_code' => '55',
            'from_name' => 'TinTest124',
            'from_phone' => '0987654321',
            'from_address' => '72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam',
            'from_ward_name' => 'Phường 14',
            'from_district_name' => 'Quận 10',
            'from_province_name' => 'HCM',
            'to_name' => 'TinTest124',
            'to_phone' => '0987654321',
            'to_address' => '72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam',
            'to_ward_name' => 'Phường 14',
            'to_district_name' => 'Quận 10',
            'to_province_name' => 'HCM',
            'cod_amount' => 200000,
            'content' => 'Theo New York Times',
            'weight' => 200,
            'length' => 1,
            'width' => 19,
            'height' => 10,
            'cod_failed_amount' => 2000,
            'pick_station_id' => 1444,
            'deliver_station_id' => null,
            'insurance_value' => 1000000,
            'service_id' => 0,
            'service_type_id' => 2,
            'coupon' => null,
            'pickup_time' => 1692840132,
            'pick_shift' => [2],
            'items' => [
                [
                    'name' => 'Áo Polo',
                    'code' => 'Polo123',
                    'quantity' => 1,
                    'price' => 200000,
                    'length' => 12,
                    'width' => 12,
                    'weight' => 1200,
                    'height' => 12,
                    'category' => [
                        'level1' => 'Áo'
                    ]
                ]
            ]
        ]; */
        
    
        $response = Http::withHeaders([
            'Token' => 'a26e2748-971a-11ee-b1d4-92b443b7a897',
            'Content-Type' => 'application/json',
            'ShopId' => '190517'
        ])->withOptions([
            'verify' => false, // Tắt xác thực SSL
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', $data);
        
    
        if ($response->successful()) {

            //Thêm vào csdl
            $responseData = $response->json();
        
            // Lấy order_code và total_fee
            $orderCode = $responseData['data']['order_code'] ?? null;
            $totalFee = $responseData['data']['total_fee'] ?? null;
    
            
            // Cập nhật vào bảng Orders
            if ($orderCode && $totalFee) {
                
                $order_id = $data['client_order_code'];
                
                Order::where('id', $order_id)->update([
                    'shipping_code' => $orderCode,
                    'shipping_cost' => $totalFee,
                    'delivery_company_code' => 'GHN'
                ]);
            }

            return $response->json();
            
        } else {
            // Xử lý lỗi
            return $response->json();
        }
    }
    public function getOrderItems($order_id){
        // Tìm đơn hàng với các orderItems
        $order = Order::with('orderItems')->find($order_id);

        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Giải mã địa chỉ và log
        $order->address = json_decode($order->address);
        $order->log = json_decode($order->log);

        // Lấy thông tin order_items
        $order->order_items = $order->orderItems->map(function ($item) {
            // Giải mã product_size_info
            $item->product_size_info = json_decode($item->product_size_info, true); // Thêm tham số true để lấy dưới dạng mảng

            // Trả về thông tin sản phẩm
            return [
                'name' => $item->product_size_info['product_name'] ?? 'Tên sản phẩm không xác định',
                'code' => 'Code' . ($item->product_size_info['product_id'] ?? 'unknown'),
                'quantity' => (int)($item->quantity ?? 1),
                'price' => (int)($item->item_value ?? 200000),
                'length' => (int)($item->product_size_info['length'] ?? 12),
                'width' => (int)($item->product_size_info['width'] ?? 12),
                'weight' => (int)($item->product_size_info['weight'] ?? 500),
                'height' => (int)($item->product_size_info['height'] ?? 12),
  /*               'category' => [
                    'level1' => 'Nước hoa' // Thay thế bằng danh mục thực tế nếu có
                ] */
            ];
        });        
    }
    public function test($order_id) {
        // Tìm đơn hàng với các orderItems
        $order = Order::with('orderItems')->find($order_id);
    
        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        // Giải mã địa chỉ và log
        $order->address = json_decode($order->address);
        $order->log = json_decode($order->log);
    
        // Lấy thông tin order_items
        $order_items = $order->orderItems->map(function ($item) {
            // Giải mã product_size_info
            $item->product_size_info = json_decode($item->product_size_info, true);
    
            // Trả về thông tin sản phẩm theo định dạng yêu cầu
            return [
                'name' => $item->product_size_info['product_name'] ?? 'Tên sản phẩm không xác định',
                'code' => 'BK' . ($item->product_size_info['product_id'] ?? 'unknown'),
                'quantity' => (int)($item->quantity ?? 1),
                'price' => (int)($item->item_value ?? 200000),
                'length' => (int)($item->product_size_info['length'] ?? 12),
                'width' => (int)($item->product_size_info['width'] ?? 12),
                'weight' => (int)($item->product_size_info['weight'] ?? 1200), // Kiểm tra giá trị này có hợp lý không
                'height' => (int)($item->product_size_info['height'] ?? 12),
                'category' => [
                    'level1' => 'Nước hoa' // Thay thế bằng danh mục thực tế nếu có
                ]
            ];
        })->toArray(); // Chuyển đổi thành mảng
    
        // Đảm bảo trả về đúng định dạng
        //return response()->json(['items' => $order_items]);
        return $order_items;
    }

    public function printOrder($orderCodes) {
        $token = $this->getToken($orderCodes);
    
        if ($token) {
            // Sử dụng string interpolation để tạo URL
            $printUrl = "https://dev-online-gateway.ghn.vn/a5/public-api/printA5?token={$token}";
            return $printUrl;
        }
    
        return ['error' => 'Unable to retrieve token'];

        
    }
    
    
    public function getToken($orderCodes) {
        // Đảm bảo orderCodes là một mảng
        if (!is_array($orderCodes)) {
            $orderCodes = [$orderCodes]; // Chuyển đổi thành mảng nếu cần
        }
    
        $response = Http::withHeaders([
            'token' => $this->token,
            'Content-Type' => 'application/json',
        ])->withOptions([
            'verify' => false, // Tắt xác thực SSL
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/a5/gen-token', [
            'order_codes' => $orderCodes
        ]);
    
        if ($response->successful()) {
            $responseData = $response->json();
            return $responseData['data']['token'] ?? null; // Trả về token nếu có
        }
    
        // Xử lý lỗi
        return $response->json();
    }
    
    

    public function getProvinceName($provinceId) {
        // Gọi API để lấy danh sách tỉnh thành phố
        $response = Http::withHeaders([
            'Token' => $this->token,
            'Content-Type' => 'application/json',
        ])->withOptions([
            'verify' => false, // Tắt xác thực SSL
        ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province');
    
        // Kiểm tra nếu request thành công
        if ($response->successful()) {
            $provinces = $response->json(); // Lấy dữ liệu dưới dạng JSON
    
            // Tìm kiếm province_id trong danh sách tỉnh
            foreach ($provinces['data'] as $province) {
                if ($province['ProvinceID'] == $provinceId) {
                    return $province['ProvinceName']; // Trả về tên tỉnh thành phố
                }
            }
        }
    
        return null; // Nếu không tìm thấy
    }
    public function getDistrictName($districtId, $provinceId) {
        // Gọi API để lấy danh sách quận huyện
        $response = Http::withHeaders([
            'Token' => $this->token,
            'Content-Type' => 'application/json',
        ])->withOptions([
            'verify' => false, // Tắt xác thực SSL
        ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district', [
            'province_id' => $provinceId // Truyền province_id trong body
        ]);
    
        // Kiểm tra nếu request thành công
        if ($response->successful()) {
            $districts = $response->json(); // Lấy dữ liệu dưới dạng JSON
    
            // Tìm kiếm district_id trong danh sách quận huyện
            foreach ($districts['data'] as $district) {
                if ($district['DistrictID'] == $districtId) {
                    return $district['DistrictName']; // Trả về tên quận huyện
                }
            }
        }
    
        return null; // Nếu không tìm thấy
    }
    public function getWardName($wardId, $districtId) {
        // Gọi API để lấy danh sách phường xã
        $response = Http::withHeaders([
            'Token' => $this->token,
            'Content-Type' => 'application/json',
        ])->withOptions([
            'verify' => false, // Tắt xác thực SSL
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward', [
            'district_id' => $districtId // Truyền district_id trong body
        ]);
    
        // Kiểm tra nếu request thành công
        if ($response->successful()) {
            $wards = $response->json(); // Lấy dữ liệu dưới dạng JSON
    
            // Kiểm tra nếu dữ liệu có trong 'data'
            if (isset($wards['data'])) {
                // Tìm kiếm ward_id trong danh sách phường xã
                foreach ($wards['data'] as $ward) {
                    if ($ward['WardCode'] == $wardId) {
                        return $ward['WardName']; // Trả về tên phường xã
                    }
                }
                return 'Phường/Xã không tồn tại'; // Thông báo nếu không tìm thấy wardId
            } else {
                return 'Không có dữ liệu phường/xã'; // Thông báo nếu không có dữ liệu
            }
        }
    
        return 'Lỗi khi lấy dữ liệu: ' . $response->status(); // Thông báo lỗi với mã trạng thái
    }

    /* Cron thực hiện cập nhật trạng thái đơn *//* 
    public function updateOrderStatus() {
        // Lấy danh sách đơn hàng cần cập nhật trạng thái
        $orders = Order::where('status', '!=', 'delivered')->get();
    
        // Duyệt qua từng đơn hàng
        foreach ($orders as $order) {
            // Gọi API để lấy trạng thái đơn hàng
            $response = Http::withHeaders([
                'Token' => $this->token,
                'Content-Type' => 'application/json',
            ])->withOptions([
                'verify' => false, // Tắt xác thực SSL
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipment-detail', [
                'order_code' => $order->shipping_code
            ]);
    
            // Kiểm tra nếu request thành công
            if ($response->successful()) {
                $responseData = $response->json(); // Lấy dữ liệu dưới dạng JSON
    
                // Lấy trạng thái từ dữ liệu trả về
                $status = $responseData['data']['status'] ?? null;
    
                // Cập nhật trạng thái đơn hàng
                if ($status) {
                    $order->status = $status;
                    $order->save();
                }
            }
        }
    } */
    
    

}

class GHNService extends ShippingService {
    private $apiUrl = 'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/';
    private $token = 'Token';
    private $shopId = 'ShopId';
    public function getShippingFee($order){
        //Gọi API của GHN để lấy phí vận chuyển
    }
    public function createShippingOrder($order) {
        $data = [
            'payment_type_id' => $order['payment_type_id'] ?? 1, // 1: người bán, 2: người mua trả phí
            'note' => $order['note'] ?? null,
            'required_note' => $order['required_note'] ?? 'KHONGCHOXEMHANG',
            'return_phone' => $order['return_phone'] ?? null,
            'return_address' => $order['return_address'] ?? null,
            'return_district_id' => $order['return_district_id'] ?? null,
            'return_ward_code' => $order['return_ward_code'] ?? null,
            'client_order_code' => $order['client_order_code'] ?? null,
            'from_name' => $order['from_name'] ?? 'TinTest124',
            'from_phone' => $order['from_phone'] ?? '0987654321',
            'from_address' => $order['from_address'] ?? '72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam',
            'from_ward_name' => $order['from_ward_name'] ?? 'Phường 14',
            'from_district_name' => $order['from_district_name'] ?? 'Quận 10',
            'from_province_name' => $order['from_province_name'] ?? 'HCM',
            'to_name' => $order['to_name'] ?? 'TinTest124',
            'to_phone' => $order['to_phone'] ?? '0987654321',
            'to_address' => $order['to_address'] ?? '72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam',
            'to_ward_name' => $order['to_ward_name'] ?? 'Phường 14',
            'to_district_name' => $order['to_district_name'] ?? 'Quận 10',
            'to_province_name' => $order['to_province_name'] ?? 'HCM',
            'cod_amount' => $order['cod_amount'] ?? 200000,
            'content' => $order['content'] ?? 'Theo New York Times',
            'weight' => $order['weight'] ?? 200,
            'length' => $order['length'] ?? 1,
            'width' => $order['width'] ?? 19,
            'height' => $order['height'] ?? 10,
            'cod_failed_amount' => $order['cod_failed_amount'] ?? 2000,
            'pick_station_id' => $order['pick_station_id'] ?? 1444,
            'deliver_station_id' => $order['deliver_station_id'] ?? null,
            'insurance_value' => $order['insurance_value'] ?? 10000000,
            'service_id' => $order['service_id'] ?? 0,
            'service_type_id' => $order['service_type_id'] ?? 2,
            'coupon' => $order['coupon'] ?? null,
            'pickup_time' => $order['pickup_time'] ?? time(),
            'pick_shift' => $order['pick_shift'] ?? [2],
            'items' => $order['items'] ?? [
                [
                    'name' => 'Áo Polo',
                    'code' => 'Polo123',
                    'quantity' => 1,
                    'price' => 200000,
                    'length' => 12,
                    'width' => 12,
                    'weight' => 1200,
                    'height' => 12,
                    'category' => [
                        'level1' => 'Áo'
                    ]
                ]
            ]
        ];
    
        $response = Http::withHeaders([
            'Token' => $this->token,
            'Content-Type' => 'application/json',
            'ShopId' => '885' // Thêm ShopId vào header
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', $data);
    
        if ($response->successful()) {
            return $response->json();
        } else {
            // Xử lý lỗi
            return null;
        }
    }
    
    public function cancelShippingOrder($order){
        //Gọi API của GHN để hủy đơn vận chuyển
    }
}

class GHTKService extends ShippingService {
    public function getShippingFee($order){
        //Gọi API của GHTK để lấy phí vận chuyển
    }
    public function createShippingOrder($order){
        //Gọi API của GHTK để tạo đơn vận chuyển
    }
    public function cancelShippingOrder($order){
        //Gọi API của GHTK để hủy đơn vận chuyển
    }
}

class OtherShippingService extends ShippingService {
    public function getShippingFee($order){
        //Gọi API của đơn vị vận chuyển khác để lấy phí vận chuyển
    }
    public function createShippingOrder($order){
        //Gọi API của đơn vị vận chuyển khác để tạo đơn vận chuyển
    }
    public function cancelShippingOrder($order){
        //Gọi API của đơn vị vận chuyển khác để hủy đơn vận chuyển
    }
}