<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\ProductService;
use App\Services\AttributeValueService;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $productService;
    protected $attributeValueService;
    protected $orderService;
    public function __construct(ProductService $productService, AttributeValueService $attributeValueService, OrderService $orderService) {
        $this->productService = $productService;
        $this->attributeValueService = $attributeValueService;
        $this->orderService = $orderService;
    }

    public function createOrder(Request $request)
    {
        //return response()->json($request->user());
        $data = $request->all();

        $data['customer_id'] = $request->user()->id ?? 3; //3 là id của Viewer Users
        $data['address'] = [
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'address' => $request->detail_address,
        ];

        //Xử lý lỗi
        $validator = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
            'detail_address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $order = $this->orderService->createOrder($data);
            return response()->json([
                'message' => 'Order created successfully',
                'data' => $order,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => null,
                'status' => 500
            ], 500);
        }

/*         $order = $this->orderService->createOrder($data);
        return response()->json($order); */
    }





    
}
