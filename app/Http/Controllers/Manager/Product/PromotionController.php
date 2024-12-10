<?php

namespace App\Http\Controllers\Manager\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PromotionService;


class PromotionController extends Controller
{
    protected $promotionService;
    public function __construct(PromotionService $promotionService) {
        $this->promotionService = $promotionService;
    }
    public function showAll(){
        $list = $this->promotionService->getAll();
        $products = $this->promotionService->getProductList();
        //$selected_products = $this->promotionService->showProductList();

        //return response($products);
        return view('manager.product.promotions', compact(['list','products']));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
        ]);
    
        $data = $request->only('name', 'start_date', 'end_date', 'code', 'discount');
        $data['product_list'] = json_encode($request->input('product_list'));

        return $this->promotionService->create($data);
    }

    public function delete(Request $request) {
        $promotion = $this->promotionService->delete($request->id);
        return $promotion;
    }

    //Home: show deal of the day
    public function getDealOfDay(){
        $promotion = $this->promotionService->getDealOfDay();
        return $promotion;
    }
}
