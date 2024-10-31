<?php 

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Str;

use App\Services\ShippingService;


class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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

    //Kết  nối đơn vị vận chuyển
    public function connectShipping($order)
    {
        $ship = new ShippingService();
        $ship->createShippingOrder($order);
    }


    //Customer
    public function createOrder($data)
    {
  
        switch ($data['payment_method']) {
            case 'Online':
                /* optional */
                break;
            default:
                $data['status'] = 0;
                $order = $this->orderRepository->createOrder($data);
                break;
        }
        return $order;
    }




}
