<?php

namespace App\Http\Controllers\Manager\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Order;
use App\Services\OrderService;


use App\Services\ShippingService;

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
        $order_timeframe = $request->order_timeframe ?? 'current_month';
        $orders = $this->orderService->getOrders($order_status,$order_timeframe);
        return response()->json($orders);
    }

    public function getOrderDetail(Request $request){
        $order_id = $request->id;
        $order = $this->orderService->getOrderDetail($order_id);
        return response()->json($order);
    }

    public function updateOrder(Request $request){
        $order_id = $request->id;
        $data = $request->data;
        if($data['status'] == 6){
            $shipping = new ShippingService();
            return $shipping->cancelOrder($order_id);
        }
        try {
            $order = $this->orderService->updateOrder($order_id, $data);
            return response()->json(['status' => 200, 'message' => 'Cập nhật đơn hàng thành công']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    //đếm số đơn hàng theo trạng thái
    public function countOrders(Request $request)
    {
        $status = $request->status ?? null;
        return $this->orderService->countOrder($request->status);
    }
    

    //Trừ sản phẩm
    public function minusProductQuantity(Request $request){
        $order_id = $request->id;
        try {
            $this->orderService->minusProductQuantity($order_id);
            return response()->json(['status' => 200, 'message' => 'Trừ sản phẩm thành công']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

    }

    public function createTicket(Request $request){
        $shipping = new ShippingService();

        $order = $request->data;

        $order_items = $shipping->test($order['client_order_code']);

        $data1 = [
            'payment_type_id' => (int)($order['payment_type_id'] ?? 1), // Mã người thanh toán phí dịch vụ: 1: Người bán, 2: Người mua
            'note' => $order['note'] ?? null, // Ghi chú cho tài xế (tùy chọn)
            'required_note' => $order['required_note'] ?? 'KHONGCHOXEMHANG', // Ghi chú bắt buộc, ví dụ: không cho phép xem hàng
            'return_phone' => $order['return_phone'] ?? null, // Số điện thoại trả hàng khi không giao được (tùy chọn)
            'return_address' => $order['return_address'] ?? null, // Địa chỉ trả hàng khi không giao được (tùy chọn)
            'return_district_id' => $order['return_district_id'] ?? null, // Quận/Huyện của địa chỉ trả hàng (tùy chọn)
            'return_ward_code' => $order['return_ward_code'] ?? null, // Phường/Xã của địa chỉ trả hàng (tùy chọn)
            'client_order_code' => $order['client_order_code'] ?? null, // Mã đơn hàng riêng của khách hàng (tùy chọn)
            'from_name' => $order['from_name'] ?? 'TinTest124', // Tên người gửi
            'from_phone' => $order['from_phone'] ?? '0987654321', // Số điện thoại người gửi
            'from_address' => $order['from_address'] ?? '72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam', // Địa chỉ người gửi
            'from_ward_name' => $order['from_ward_name'] ?? 'Phường 14', // Phường/Xã của người gửi
            'from_district_name' => $order['from_district_name'] ?? 'Quận 10', // Quận/Huyện của người gửi
            'from_province_name' => $order['from_province_name'] ?? 'HCM', // Tỉnh của người gửi
            'to_name' => $order['to_name'] ?? 'TinTest124', // Tên người nhận hàng
            'to_phone' => $order['to_phone'] ?? '0987654321', // Số điện thoại người nhận hàng
            'to_address' => $order['to_address'] ?? '72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam', // Địa chỉ người nhận hàng
            'to_ward_name' => $order['to_ward_name'] ?? 'Phường 14', // Phường/Xã của người nhận
            'to_district_name' => $order['to_district_name'] ?? 'Quận 10', // Quận/Huyện của người nhận
            'to_province_name' => $order['to_province_name'] ?? 'HCM', // Tỉnh của người nhận
            'to_district_id' => (int)($order['to_district_id'] ?? 3303), // Mã quận/huyện của người nhận
            'to_ward_code' => $order['to_ward_code'] ?? 13009, // Mã phường/xã của người nhận
            'cod_amount' => (int)($order['cod_amount'] ?? 0), // Tiền thu hộ cho người gửi, mặc định là 0
            'content' => $order['content'] ?? 'Theo New York Times', // Nội dung của đơn hàng
            'weight' => (int)($order['weight'] ?? 200), // Khối lượng của đơn hàng (gram), mặc định là 200
            'length' => (int)($order['length'] ?? 1), // Chiều dài của đơn hàng (cm), mặc định là 1
            'width' => (int)($order['width'] ?? 19), // Chiều rộng của đơn hàng (cm), mặc định là 19
            'height' => (int)($order['height'] ?? 10), // Chiều cao của đơn hàng (cm), mặc định là 10
            'cod_failed_amount' => (int)($order['cod_failed_amount'] ?? 2000), // Tiền thu thêm khi giao hàng thất bại
            'pick_station_id' => $order['pick_station_id'] ?? null, // Mã bưu cục để gửi hàng tại điểm (tùy chọn)
            'deliver_station_id' => $order['deliver_station_id'] ?? null, // Mã bưu cục giao hàng (tùy chọn)
            'insurance_value' => 1000000, // Giá trị của đơn hàng (tối đa 5.000.000)
            'service_id' => (int)($order['service_id'] ?? 0), // Mã dịch vụ (tùy chọn)
            'service_type_id' => (int)($order['service_type_id'] ?? 2), // Mã loại dịch vụ, mặc định là 2: Hàng nhẹ
            'coupon' => $order['coupon'] ?? null, // Mã giảm giá (tùy chọn)
            'pickup_time' => (int)($order['pickup_time'] ?? time()), // Thời gian mong muốn lấy hàng (Unix timestamp)
            'pick_shift' => $order['pick_shift'] ?? [2], // Ca lấy hàng (tùy chọn, mặc định là [2])
            'items' => $order_items ?? [ // Thông tin sản phẩm, bắt buộc truyền items khi sử dụng gói dịch vụ Hàng nặng
                [
                    'name' => 'Nước hoa BKP', // Tên sản phẩm
                    'code' => 'BKP1', // Mã sản phẩm
                    'quantity' => (int)($order['items'][0]['quantity'] ?? 1), // Số lượng sản phẩm
                    'price' => (int)($order['items'][0]['price'] ?? 200000), // Giá sản phẩm
                    'length' => (int)($order['items'][0]['length'] ?? 12), // Chiều dài sản phẩm
                    'width' => (int)($order['items'][0]['width'] ?? 12), // Chiều rộng sản phẩm
                    'weight' => (int)($order['items'][0]['weight'] ?? 1200), // Khối lượng sản phẩm
                    'height' => (int)($order['items'][0]['height'] ?? 12), // Chiều cao sản phẩm
                    'category' => [ // Danh mục sản phẩm
                        'level1' => 'Áo' // Danh mục cấp 1
                    ]
                ]
            ]
        ];
        
        
        //$respone = $shipping->createShippingOrder($data1);
        $respone = $shipping->calculateFee($data1);
        return response()->json($respone);
    }
    public function submitTicket(Request $request){
        

        $order = $request->data;

        //Kiểm tra $order['shipping-partner'] 1:GHN, 2:GHTK, 3:OTHER

        $shipping = new ShippingService();
        $order_items = $shipping->test($order['client_order_code']);

        
        $data1 = [
            'payment_type_id' => (int)($order['payment_type_id'] ?? 1), // Mã người thanh toán phí dịch vụ: 1: Người bán, 2: Người mua
            'note' => $order['note'] ?? null, // Ghi chú cho tài xế (tùy chọn)
            'required_note' => $order['required_note'] ?? 'KHONGCHOXEMHANG', // Ghi chú bắt buộc, ví dụ: không cho phép xem hàng
            'return_phone' => $order['return_phone'] ?? null, // Số điện thoại trả hàng khi không giao được (tùy chọn)
            'return_address' => $order['return_address'] ?? null, // Địa chỉ trả hàng khi không giao được (tùy chọn)
            'return_district_id' => $order['return_district_id'] ?? null, // Quận/Huyện của địa chỉ trả hàng (tùy chọn)
            'return_ward_code' => $order['return_ward_code'] ?? null, // Phường/Xã của địa chỉ trả hàng (tùy chọn)
            'client_order_code' => $order['client_order_code'] ?? null, // Mã đơn hàng riêng của khách hàng (tùy chọn)
            'from_name' => $order['from_name'] ?? 'BK Perfume', // Tên người gửi
            'from_phone' => $order['from_phone'] ?? '0987654321', // Số điện thoại người gửi
            'from_address' => $order['from_address'] ?? '122, Phường Trương Định, Quận Hai Bà Trưng, Hà Nội, Vietnam', 
            'from_ward_name' => $order['from_ward_name'] ?? 'Phường Trương Định', 
            'from_district_name' => $order['from_district_name'] ?? 'Quận Hai Bà Trưng', 
            'from_province_name' => $order['from_province_name'] ?? 'Hà Nội', 
/*             'from_address' => '122, Phường Trương Định, Quận Hai Bà Trưng, Hà Nội, Vietnam', 
            'from_ward_name' => 'Phường Trương Định', 
            'from_district_name' => 'Quận Hai Bà Trưng', 
            'from_province_name' => 'Hà Nội',  */

            'to_name' => $order['to_name'] ?? 'TinTest124', // Tên người nhận hàng
            'to_phone' => $order['to_phone'] ?? '0987654321', // Số điện thoại người nhận hàng
            'to_address' => $order['to_address'] ?? '72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam', // Địa chỉ người nhận hàng
            'to_ward_name' => $order['to_ward_name'] ?? 'Phường 14', // Phường/Xã của người nhận
            'to_district_name' => $order['to_district_name'] ?? 'Quận 10', // Quận/Huyện của người nhận
            'to_province_name' => $order['to_province_name'] ?? 'HCM', // Tỉnh của người nhận
            'to_district_id' => (int)($order['to_district_id'] ?? 3303), // Mã quận/huyện của người nhận
            'to_ward_code' => $order['to_ward_code'] ?? 13009, // Mã phường/xã của người nhận
            'cod_amount' => (int)($order['cod_amount'] ?? 0), // Tiền thu hộ cho người gửi, mặc định là 0
            'content' => $order['content'] ?? 'Theo New York Times', // Nội dung của đơn hàng
            'weight' => (int)($order['weight'] ?? 200), // Khối lượng của đơn hàng (gram), mặc định là 200
            'length' => (int)($order['length'] ?? 1), // Chiều dài của đơn hàng (cm), mặc định là 1
            'width' => (int)($order['width'] ?? 19), // Chiều rộng của đơn hàng (cm), mặc định là 19
            'height' => (int)($order['height'] ?? 10), // Chiều cao của đơn hàng (cm), mặc định là 10
            'cod_failed_amount' => (int)($order['cod_failed_amount'] ?? 2000), // Tiền thu thêm khi giao hàng thất bại
            'pick_station_id' => $order['pick_station_id'] ?? null, // Mã bưu cục để gửi hàng tại điểm (tùy chọn)
            'deliver_station_id' => $order['deliver_station_id'] ?? null, // Mã bưu cục giao hàng (tùy chọn)
            'insurance_value' => 1000000, // Giá trị của đơn hàng (tối đa 5.000.000)
            'service_id' => (int)($order['service_id'] ?? 0), // Mã dịch vụ (tùy chọn)
            'service_type_id' => (int)($order['service_type_id'] ?? 2), // Mã loại dịch vụ, mặc định là 2: Hàng nhẹ
            'coupon' => $order['coupon'] ?? null, // Mã giảm giá (tùy chọn)
            'pickup_time' => (int)($order['pickup_time'] ?? time()), // Thời gian mong muốn lấy hàng (Unix timestamp)
            'pick_shift' => $order['pick_shift'] ?? [2], // Ca lấy hàng (tùy chọn, mặc định là [2])
            'items' => $order_items ?? [ // Thông tin sản phẩm, bắt buộc truyền items khi sử dụng gói dịch vụ Hàng nặng
                [
                    'name' => 'Nước hoa Test', // Tên sản phẩm
                    'code' => 'BK12', // Mã sản phẩm
                    'quantity' => (int)($order['items'][0]['quantity'] ?? 1), // Số lượng sản phẩm
                    'price' => (int)($order['items'][0]['price'] ?? 200000), // Giá sản phẩm
                    'length' => (int)($order['items'][0]['length'] ?? 12), // Chiều dài sản phẩm
                    'width' => (int)($order['items'][0]['width'] ?? 12), // Chiều rộng sản phẩm
                    'weight' => (int)($order['items'][0]['weight'] ?? 1200), // Khối lượng sản phẩm
                    'height' => (int)($order['items'][0]['height'] ?? 12), // Chiều cao sản phẩm
                    'category' => [ // Danh mục sản phẩm
                        'level1' => 'Áo' // Danh mục cấp 1
                    ]
                ]
            ]
        ];
        
        
        $respone = $shipping->createShippingOrder($data1);
        //$respone = $shipping->calculateFee($data1);
        return response()->json($respone);
    }
    //Hủy đơn hàng : chú ý 1 số trạng thái mới có thể hủy: ready_to_pick, picking, money_collect_picking, từ picked trở đi không thể hủy
    public function cancelOrder(Request $request){
        $order_id = $request->id;
        $shipping = new ShippingService();
        $response = $shipping->cancelOrder($order_id);
        return response()->json($response);
    }


    public function printOrder(Request $request){
        $order_id = $request->id;
        $order = Order::find($order_id);
        $shipping_code = $order->shipping_code;
        $delivery_company_code = $order->delivery_company_code;
        if ($delivery_company_code != 'GHN') {
            return response()->json(['status' => 500, 'message' => 'Phiếu đóng gói sử dụng dịch vụ ngoài']);
        }

        $print = new ShippingService();
        $response = $print->printOrder($shipping_code);
        //return redirect($response);
        return $response;
    }

    public function getAddress(Request $request) {
        //http://127.0.0.1:8000/admin/order/get-address?province_id=201&district_id=3303&ward_id=13009
        $province = $request->province_id;
        $district = $request->district_id;
        $ward = $request->ward_id; 
        $detail = $request->detail;
        $shipping = new ShippingService();
        //hàm getWardName tham số province_id: int
        $address = $detail.'/'.$shipping->getProvinceName($province) . '/ ' . $shipping->getDistrictName($district,$province) . '/ ' . $shipping->getWardName($ward,(int)$district);
        return response()->json($address);
    }
    
}
