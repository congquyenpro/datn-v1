<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;


class DisplayController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function displayHome(){
        return view('customer.home');
    }
    
    public function displayProduct(Request $request){
        $product = $this->productService->getProductBySlug($request->slug);
        $related_products = $this->productService->getRelatedProduct($product->id);
        return view('customer.product-detail',compact('product','related_products'));
    }

    public function checkout(){
        return view('customer.checkout');
    }

    public function orderSuccess(Request $request){
        $orderId = $request->query('id'); 
        return view('customer.order-success',compact('orderId'));
    }
    public function orderDetail(Request $request){
        return view('customer.order-detail',);
    }


    
}
