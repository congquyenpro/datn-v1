<?php 
namespace App\Services;
use App\Repositories\OrderRepository;
use App\Models\User;
class SettingService {
    private $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    //Get user order list
    public function getCustomerOrderList($customer_type){
        $list = $this->orderRepository->getCustomerOrderList($customer_type);
        return $list;
    }
    //Get user detail
    public function getUserDetail($id){
        $user = $this->orderRepository->getCustomerDetail($id);
        return $user;
    }

    //Set user status
    public function setUserStatus($user_id, $status){
        $user = User::find($user_id)->update(['status' => $status]);
        return $user;
    }

    //Get all orders of user detail
    public function getUserOrderDetail($id){
        $order = $this->orderRepository->getUserOrderDetail($id);
        return $order;
    }

}