<?php 
namespace App\Services;
use Illuminate\Support\Facades\Http;

class ShippingService {
    private $apiUrl = 'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/';
    private $token = 'a26e2748-971a-11ee-b1d4-92b443b7a897';
    private $shopId = '2506614';
    
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
            'ShopId' => '2506614'
        ])->withOptions([
            'verify' => false, // Tắt xác thực SSL
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', $data);
        
    
        if ($response->successful()) {
            return $response->json();
        } else {
            // Xử lý lỗi
            return null;
        }
    }

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