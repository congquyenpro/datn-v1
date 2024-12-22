<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\ShippingService;


class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Kiểm tra dữ liệu nhận được
        $data = $request->all();

        // Log dữ liệu để kiểm tra (nếu cần)
        \Log::info('GHN Webhook Data:', $data);

        // Kiểm tra type của webhook
        $type = $data['Type'] ?? null;

        switch ($type) {
            case 'create':
                $this->handleCreateOrder($data);
                break;

            case 'switch_status':
                $this->handleSwitchStatus($data);
                break;

            case 'update_weight':
                $this->handleUpdateWeight($data);
                break;

            case 'update_cod':
                $this->handleUpdateCod($data);
                break;

            case 'update_fee':
                $this->handleUpdateFee($data);
                break;

            default:
                \Log::warning('Unknown webhook type:', ['type' => $type]);
                break;
        }

        // Trả về HTTP Response 200 để GHN không gửi lại
        return response()->json(['message' => 'Webhook handled successfully'], 200);
    }

    private function handleCreateOrder(array $data)
    {
        \Log::info('Handle Create Order:', $data);
        // Xử lý logic cho create order
    }

    private function handleSwitchStatus(array $data)
    {
        \Log::info('Handle Switch Status:', $data);
        // Xử lý logic khi đổi trạng thái
    }

    private function handleUpdateWeight(array $data)
    {
        \Log::info('Handle Update Weight:', $data);
        // Xử lý logic khi cập nhật khối lượng
    }

    private function handleUpdateCod(array $data)
    {
        \Log::info('Handle Update COD:', $data);
        // Xử lý logic khi cập nhật tiền COD
    }

    private function handleUpdateFee(array $data)
    {
        \Log::info('Handle Update Fee:', $data);
        // Xử lý logic khi cập nhật phí
    }


    public function lookupOrderDetail(Request $request) {
        $shippingService = new ShippingService();
        $response = $shippingService->lookupOrderDetail($request->order_code, $request->phone);
        return $response;
    }
    
    //Cập nhật trạng thái đơn hàng qua api (thủ công khi chưa config webhook trên GHN)
    public function updateOrderStatus(Request $request) {
        $order_code = $request->order_code;

        //Lấy ra order
        $order = Order::where('shipping_code', $order_code)->first();
        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
                'status' => 404
            ], 404);
        }
        if ($order->delivery_company_code != 'GHN') {
            return response()->json([
                'message' => 'Only support GiaoHangNhanh',
                'status' => 400
            ], 400);
        }

        $ref_status_code = [
            'ready_to_pick' => 3,
            'picking' => 3,
            'money_collect_picking' => 3,

            'cancel' => 6,

            'picked' => 4,
            'storing' => 4,
            'transporting' => 4,
            'sorting' => 4,
            'delivering' => 4,
            'money_collect_delivering' => 4,

            'delivered' => 5,
            'delivery_fail' => 5,  //Gh thất bại (giao lại 3 lần)
            'waiting_to_return' => 5, //Giao lại

            'return' => 7,
            'return_transporting' => 7,
            'return_sorting' => 7,
            'returning' => 7,
            'return_fail' => 7,

            'returned' => 8,

            'exception' => 6,
            'damage' => 6,
            'lost' => 6,
        ];
        $shipping = new ShippingService();
        $response = $shipping->lookupOrderDetail($order_code);

        $order_status = $ref_status_code[$response['data']['status']];

        //Lấy ra status hiện tại của đơn hàng
        $status = $order->status;
        if ($status == $order_status) {
            return response()->json([
                'message' => 'Order status is up to date',
                'status' => 200
            ], 200);
        }else {
            if ($order_status == 5) {
                $order->payment_status = 1;
            }
            $order->status = $order_status;
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
            $log[] = date('Y-m-d H:i:s') . ' - ' . $data_log_index[$order_status];
            $order->log = json_encode($log);
            $order->save();

            return response()->json([
                'message' => 'Order status updated successfully: ' . $data_log_index[$order_status],
                'status' => 200,
                'new_status' => $order_status
            ], 200);
        }
    }

}
