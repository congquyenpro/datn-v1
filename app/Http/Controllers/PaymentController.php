<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Models\Order;

class PaymentController extends Controller
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function displayPayment(Request $request)
    {
        $order_code = $request->order_code;
        $order_id = substr($order_code, 2);

        try {
            $order = Order::find($order_id);
            
            if (!$order) {
                // Nếu không tìm thấy đơn hàng, ném ngoại lệ
                throw new \Exception("Order not found");
            }
        
            $order_value = $order->value;
            return view('customer.payment', compact('order_value'));
        } catch (\Exception $e) {
            return redirect()->route('customer.home');
        }
        
    }

    public function handleWebhook(Request $request)
    {
        return $this->paymentService->handleWebhook($request);
    }

    public function getAllTransactions()
    {
        return $this->paymentService->getAllTransactions();
    }

    public function cron(){
        return $this->paymentService->cron();
    }
    public function cron2(){
        $this->paymentService->cron2();
    }

    public function checkPayment(Request $request)
    {
        //Cập nhật dữ liệu về db : Chỉ sử dụng khi chưa public project - phải dùng ncquyen.com/
        //Khi public project thì wbehook sẽ tự động cập nhật về db, chỉ cần gọi đến db
        $this->paymentService->cron2();

        $order_code = $request->order_code;
        $order_id = substr($order_code, 2);
        return $this->paymentService->checkPayment($order_id);
    }


    //XỬ lý đơn hàng
    public function ghnWebhook(Request $request)
    {
       $order_id = $request->ClientOrderCode;
       $order = Order::find($order_id);

       //Lấy ra log cũ
       $log = json_decode($order->log);

       // Kiểm tra xem log đã được khởi tạo thành mảng chưa
       if (!is_array($log)) {
           //chuyển về log cũ về mảng
           $log = [$log];

           //$log = []; // Khởi tạo lại thành mảng nếu không phải
       }

       $status = $request->Status;

       switch ($status) {
           case 'picking':
               $data = [
                   'status' => 3,
                    'log' =>  date('Y-m-d H:i:s').' - Chờ lấy hàng'
               ];
               break;
           case 'delivering':
               $data = [
                   'status' => 4,
                    'log' =>  date('Y-m-d H:i:s').' - Đang giao hàng'
               ];
               break;
           case 'delivered':
               $data = [
                   'status' => 5,
                    'log' =>  date('Y-m-d H:i:s').' - Đã giao hàng'
               ];
               break;
           case 'delivery_fail':
               $data = [
                   'status' => 6,
                    'log' =>  date('Y-m-d H:i:s').' - Giao hàng thất bại'
               ];
               break;
           default:
               $data = [
                   'status' => 6,
                    'log' =>  date('Y-m-d H:i:s').' - Giao hàng thất bại'
               ];
               break;
       }
        $log[] = $data['log'];

        $order->log = json_encode($log);
        $order->status = $data['status'];
        $order->save();
        return response()->json($order);
    }

}
