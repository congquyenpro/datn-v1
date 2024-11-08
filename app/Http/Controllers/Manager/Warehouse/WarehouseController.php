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
    public function showInventory(){
        return view('manager.warehouse.inventory');
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

    public function store (Request $request){
        return $this->warehouseService->store($request);
        //return response()->json(['success' => 'Product added successfully']);
    }

    public function getInventoryChanges(){
        $inventoryChanges = $this->warehouseService->getInventoryChanges();
        return response()->json($inventoryChanges);
    }
    public function getInventoryChangeDetails(Request $request){
        $ticketId = $request->ticketId;
        $inventoryChangeDetails = $this->warehouseService->getInventoryChangeDetails($ticketId);
        return response()->json($inventoryChangeDetails);
    }
    public function getChangeDetails(Request $request){
        $ticketId = $request->ticketId;
        $changeDetails = $this->warehouseService->getChangeDetails($ticketId);
        return response()->json($changeDetails);
    }


}
