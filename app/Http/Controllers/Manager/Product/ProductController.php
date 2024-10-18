<?php

namespace App\Http\Controllers\Manager\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CategoryService;

class ProductController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    /* Product*/
    public function showProducts(){
        return view('manager.product.products');
    }
    public function addProduct(){
        
    }
    public function editProduct(){
        
    }
    public function deleteProduct(){
        
    }

    /* Deal */
    public function showDeals(){
        return view('manager.product.deals');
    }

    
}
