<?php

namespace App\Http\Controllers\Manager\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingService;

class CustomerController extends Controller
{
    private $SettingService;
    public function __construct(SettingService $SettingService){
        $this->SettingService = $SettingService;
    }

    //Quản lý khách hàng
    public function index() {
        //$user_order_list = $this->SettingService->getCustomerOrderList();
        //return response()->json($user_order_list);
        return view('manager.system.customer');
    }
    public function getCustomerOrderList (Request $request) {
        $customer_type = $request->customer_type ?? 'system';
        $list =  $this->SettingService->getCustomerOrderList($customer_type);
        return response()->json($list);
    }
    //Lấy thông tin chi tiết 1 khách hàng
    public function getUserInfor(Request $request) {
        $id = $request->user_id;
        $user = $this->SettingService->getUserDetail($id);
        return response()->json($user);
    }
    //Cập nhật trạng thái khách hàng
    public function setUserStatus(Request $request) {
        $user_id = $request->user_id;
        $status = $request->status;
        $user = $this->SettingService->setUserStatus($user_id, $status);
        return response()->json($user);
    }

    //xem chi tiết
    public function getUserOrderDetail(Request $request) {
        $id = $request->user_id;
        $list = $this->SettingService->getUserOrderDetail($id);
        return response()->json($list);
    }
}
