<?php

namespace App\Http\Controllers\Manager\Product;

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

    /* Product*/
    public function showProducts(){
        return view('manager.product.products');
    }
    public function store(Request $request)
    {
        \Log::info('Store method called with data:', $request->all());
        $validatedData = $request->validate([
            'product.name' => 'required|string|max:255',
            'product.price' => 'required|integer',
            'product.gender' => 'required|integer',
            'product.images' => 'required|string',
            'product.short_description' => 'required|string',
            'product.detail_description' => 'required|string',
            'sizes.*.volume' => 'required|integer',
            'sizes.*.quantity' => 'required|integer',
            'sizes.*.price' => 'required|integer',
            'sizes.*.discount' => 'nullable|integer',
            'attributes.*.value_id' => 'required|integer',
        ]);

/*         $product = $this->productService->addNewProduct($validatedData);

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201); */

        return response()->json(['message' => 'Product created successfully'], 201);
    }
    public function update(Request $request){

    }
    public function delete(Request $request){

    }
    public function show(Request $request){

    }

    public function getAllAttributes(Request $request)
    {
        $attributes = [
            'brand' => $this->attributeValueService->getAllValuesOfAttribute(7),
            'concentration' => $this->attributeValueService->getAllValuesOfAttribute(1),
            'style' => $this->attributeValueService->getAllValuesOfAttribute(2),
            'frag_group' => $this->attributeValueService->getAllValuesOfAttribute(3),
            'frag_time' => $this->attributeValueService->getAllValuesOfAttribute(4),
            'frag_distance' => $this->attributeValueService->getAllValuesOfAttribute(5),
            'age_group' => $this->attributeValueService->getAllValuesOfAttribute(8),
            'ingredients' => $this->attributeValueService->getAllValuesOfAttribute(9), // Giả sử ID 9 là ingredients
            'country' => $this->attributeValueService->getAllValuesOfAttribute(6),
        ];

        return response()->json($attributes, 200);
    }

    public function getAllValues($attribute)
    {
        $method = 'getAll' . ucfirst($attribute);
        
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        // Xử lý khi không tìm thấy phương thức
        return response()->json(['error' => 'Method not found'], 404);
    }
    public function getAllConcentration(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(1);
        return response()->json($data, 200);
    }
    public function getAllStyle(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(2);
        return response()->json($data, 200);
    }
    public function getAllFragGroup(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(3);
        return response()->json($data, 200);
    }
    public function getAllFragTime(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(4);
        return response()->json($data, 200);
    }
    public function getAllFragDistance(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(5);
        return response()->json($data, 200);
    }
    public function getAllCountry(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(6);
        return response()->json($data, 200);
    }
    public function getAllBrand(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(7);
        return response()->json($data, 200);
    }
    public function getAllAgeGroup(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(8);
        return response()->json($data, 200);
    }
/*     public function getAllIngredient(Request $request){
        $data = $this->attributeValueService->getAllValuesOfAttribute(9);
        return response()->json($data, 200);
    } */




    
}
