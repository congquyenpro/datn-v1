<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\OrderService;
use App\Services\BlogService;
use App\Services\SettingService;


class DisplayController extends Controller
{
    protected $productService;
    protected $orderService;
    protected $blogService;
    protected $settingService;

    public function __construct(ProductService $productService, OrderService $orderService, BlogService $blogService, SettingService $settingService) {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->blogService = $blogService;
        $this->settingService = $settingService;   
    }

    public function displayHome(){
        $blogs = $this->blogService->getLatestPosts();
        $template_config = $this->settingService->getTemplateConfig();
        //dd($template_config);
        //dd($blog);
        return view('customer.home',compact('blogs','template_config'));
    }
    public function about(){
        $contactConfig = $this->settingService->getContactConfig();
        //dd($contactConfig);
        return view('customer.about',compact('contactConfig'));
    }
    
    public function displayProduct(Request $request){
        $product = $this->productService->getProductBySlug($request->slug);
        $related_products = $this->productService->getRelatedProduct($product->id);
        $similar_products = $this->productService->getSimilarProduct($product->id);
        return view('customer.product-detail',compact('product','related_products','similar_products'));
    }
    public function cart(){
        return view('customer.cart');
    }

    public function checkout(){
        return view('customer.checkout');
    }

    public function orderSuccess(Request $request){
        $orderId = $request->query('id'); 
        return view('customer.order-success',compact('orderId'));
    }
    public function orderDetail(Request $request){
        $orderId = $request->order_id;
        $orderId = substr($orderId, 2);
        try {
            $order = $this->orderService->getOrderDetail($orderId);
            return view('customer.order-detail',compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('customer.home');
        }
    }


    //User Profile
    public function userProfile(){
        $user_info = $this->getCurrentUser();
        return view('customer.profile.information',compact('user_info'));
    }
    public function userSecurity(){
        $user_info = $this->getCurrentUser();
        return view('customer.profile.security',compact('user_info'));
    }
    public function userOrder(){
        $user_info = $this->getCurrentUser();
        return view('customer.profile.order',compact('user_info'));
    }
    public function userOrderDetail(){
        return view('customer.user-order-detail');
    }

    //get current user info
    public function getCurrentUser(){
        $user['id'] = auth()->user()->id ?? '';
        $user['name'] = auth()->user()->name ?? '';
        $user['email'] = auth()->user()->email ?? '';
        $user['gender'] = auth()->user()->gender ?? '';
        $user['phone'] = auth()->user()->phone ?? '';
        $user['address'] = json_decode(auth()->user()->address) ?? '';
        $user['avatar'] = auth()->user()->avatar ?? '';
        $user['status'] = auth()->user()->status ?? '';
        $user['birthday'] = auth()->user()->birthday ?? '';
        return $user;
    }
    public function getUserJson()
    {
        $user = $this->getCurrentUser();
        return response()->json([
            'user_infor' => $user,
            'status' => "success",
        ]);
    }
    



    
}
