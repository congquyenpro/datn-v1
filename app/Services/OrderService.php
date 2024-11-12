<?php 

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Str;

use App\Services\ShippingService;
use App\Services\PaymentService;


class OrderService
{
    protected $orderRepository;
    protected $paymentService;

    public function __construct(OrderRepository $orderRepository, PaymentService $paymentService)
    {
        $this->orderRepository = $orderRepository;
        $this->paymentService = $paymentService;
    }

    //Admin
    public function getOrders($order_status)
    {
        switch ($order_status) {
            case 1202:
                $orders = $this->orderRepository->all();
                break;
            default:
                $orders = $this->orderRepository->getOrdersByStatus($order_status);
                break;
        }
        return $orders;
    }
    public function getOrderDeatil($order_id)
    {
        $order = $this->orderRepository->getOrderDetail($order_id);
        return $order;
    }
    public function updateOrder($order_id, $data)
    {
        $order = $this->orderRepository->update($order_id, $data);
        return $order;
    }

    //Trừ đi số lượng sản phẩm của order đã xác nhận
    public function minusProductQuantity($order_id)
    {
        $update = $this->orderRepository->minusProductQuantity($order_id);
    }

    //Kết  nối đơn vị vận chuyển
    public function connectShipping($data)
    {
        $ship = new ShippingService();
        $ship->createShippingOrder($data);
    }


    //Customer
    public function createOrder($data)
    {
  
        switch ($data['payment_method']) {
            case 'Online':
                $data['status'] = 0;
                //Tạo order
                $order_create = $this->orderRepository->createOrder($data);
                //lấy ra mã order vừa tạo
                $order_id = $order_create;

                //Tạo đơn thanh toán
                $order = $this->paymentService->createPayment($order_id);

                break;
            default:
                $data['status'] = 0;
                $order = $this->orderRepository->createOrder($data);
                break;
        }
        return $order;
    }
    public function getOrderByUser($user_id,$status)
    {
        $orders = $this->orderRepository->getOrderByUser($user_id,$status);
        return $orders;
    }

    public function getOrderByUser2($user_id,$status)
    {
        $orders = $this->orderRepository->getOrderByUser2($user_id,$status);
        return $orders;
    }





}
