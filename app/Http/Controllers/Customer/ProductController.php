<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ProductService;
use App\Services\AttributeValueService;

class ProductController extends Controller
{
    protected $productService;
    protected $attributeValueService;
    public function __construct(ProductService $productService, AttributeValueService $attributeValueService) {
        $this->productService = $productService;
        $this->attributeValueService = $attributeValueService;
    }

    //get product by type
    public function getProductByType(Request $request)
    {
        $products = $this->productService->getProductByType($request->type);
        return response()->json($products);
    }

    //get product detail
    public function getProductDetail(Request $request)
    {
        $product = $this->productService->getProductBySlug($request->slug);
        return response()->json($product);
    }
    
    //get related product: get product by category
    public function getRelatedProduct($product_id)
    {
        $products = $this->productService->getRelatedProduct($product_id);
        return response()->json($products);
    }


    
}
