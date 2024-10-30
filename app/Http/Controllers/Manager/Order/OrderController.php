<?php

namespace App\Http\Controllers\Manager\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;
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
}
