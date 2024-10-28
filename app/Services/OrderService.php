<?php 

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Str;


class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function createOrder($data)
    {
  
        switch ($data['payment_method']) {
            case 'Online':
                
                break;
            default:
                $data['status'] = 0;
                $order = $this->orderRepository->createOrder($data);
                break;
        }
        return $order;
    }


}
