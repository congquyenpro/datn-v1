<?php

namespace App\Http\Controllers\Manager\Warehouse;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\WarehouseService;


class WarehouseController extends Controller
{
    protected $warehouseService;
    public function __construct(WarehouseService $warehouseService) {
        $this->warehouseService = $warehouseService;
    }

    public function index(){
        //$products = $this->warehouseService->getProducts();
        return view('manager.warehouse.home');
    }

    public function getAllProducts(){
        $products = $this->warehouseService->getProducts();
        return response()->json($products);
    }

    public function getProductSizes(Request $request){
        $product_id = $request->product_id;
        $productSizes = $this->warehouseService->getProductSizes($product_id);
        return response()->json($productSizes);
    }


}
