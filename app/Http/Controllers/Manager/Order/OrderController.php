<?php

namespace App\Http\Controllers\Manager\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    //

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
        switch($order_status){
            case 1202:
                $orders = Order::all();
                break;
            default:
                $orders = Order::where('status', $order_status)->get();
                break;
        }
        
        return response()->json($orders);
    }
}
