<?php

namespace App\Http\Controllers\Manager\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Order;
use App\Services\OrderService;


use App\Services\GHNService;

class OrderController extends Controller
{
    protected $orderService;
    protected $ghnService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    public function index(Request $request){
        return view('manager.order.index');
    }

    //paging
    public function getOrders1(Request $request){
        $orders = Order::paginate(10);
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => Order::count(), // Tổng số bản ghi không lọc
            "recordsFiltered" => $orders->total(), // Tổng số bản ghi sau khi áp dụng bộ lọc
            "data" => $orders->items() // Các bản ghi cho trang hiện tại
        ]);
    }

    //not paging
    public function getOrders(Request $request){
        $order_status = $request->order_status ?? 0;
        $orders = $this->orderService->getOrders($order_status);
        
        return response()->json($orders);
    }

    public function getOrderDetail(Request $request){
        $order_id = $request->id;
        $order = $this->orderService->getOrderDeatil($order_id);
        return response()->json($order);
    }

    public function updateOrder(Request $request){
        $order_id = $request->id;
        $data = $request->data;
        try {
            $order = $this->orderService->updateOrder($order_id, $data);
            return response()->json(['status' => 200, 'message' => 'Cập nhật đơn hàng thành công']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function updateOrder2(Request $request){
        $order_id = $request->id;
        $order = $request->data;
        $data1 = [
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
        $data = [
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
        ];
        
    
        $response = Http::withHeaders([
            'Token' => 'a26e2748-971a-11ee-b1d4-92b443b7a897',
            'Content-Type' => 'application/json',
            'ShopId' => '190517'
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
