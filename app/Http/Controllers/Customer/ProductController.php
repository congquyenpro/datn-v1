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
    //shop
    public function shop(){
        return view('customer.shop');
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
    //get similar product: using TF-IDF
    public function getSimilarProduct($product_id)
    {
        $products = $this->productService->getSimilarProduct($product_id);
        return $products;
    }

    //get all attributes-values
    public function getAllAttributes(Request $request)
    {
        $attributes = [
            'data' => [
                'brand' => $this->attributeValueService->getAllValuesOfAttribute(7),
                'concentration' => $this->attributeValueService->getAllValuesOfAttribute(1),
                'style' => $this->attributeValueService->getAllValuesOfAttribute(2),
                'frag_group' => $this->attributeValueService->getAllValuesOfAttribute(3),
                'frag_time' => $this->attributeValueService->getAllValuesOfAttribute(4),
                'frag_distance' => $this->attributeValueService->getAllValuesOfAttribute(5),
                'age_group' => $this->attributeValueService->getAllValuesOfAttribute(8),
                'ingredients' => $this->attributeValueService->getAllValuesOfAttribute(9), // Giả sử ID 9 là ingredients
                'country' => $this->attributeValueService->getAllValuesOfAttribute(6),
            ]
        ];

        return response()->json($attributes, 200);
    }


    
}
