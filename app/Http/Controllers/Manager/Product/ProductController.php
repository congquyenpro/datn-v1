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
    
        try {
            // Xác thực dữ liệu
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'category_id' => 'required|integer',
                'gender' => 'required|integer',
                'short_description' => 'required|string',
                'description' => 'required|string',

                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Hình ảnh hợp lệ với giới hạn kích thước 2MB

                'attributes' => 'required|array',
                'attributes.*.name' => 'required|string',
                'attributes.*.value_id' => 'required|integer',

                'product_variants' => 'required|array',
                'product_variants.*.size' => 'required|integer',
                'product_variants.*.price' => 'required|integer',
                'product_variants.*.discount' => 'nullable|integer',
                'product_variants.*.quantity' => 'required|integer',



            ]);
                // Lưu các hình ảnh
/*                 $imagePaths = [];
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('images', 'public'); // Lưu ảnh vào thư mục 'public/images'
                        $imagePaths[] = $path;
                    }
                } */
    
            // Thực hiện logic thêm sản phẩm nếu dữ liệu hợp lệ
            $product = $this->productService->addNewProduct($validatedData);
    
            return response()->json(['message' => 'Product created successfully'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Trả về lỗi dạng JSON nếu xác thực không thành công
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors() // Trả về các lỗi xác thực chi tiết
            ], 422);
        }
    }

    public function getAllProducts(Request $request)
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }
    public function getProductDetail(Request $request, $id)
    {
        $product = $this->productService->getProductDetail($id);
        return response()->json($product);
    }
    
    public function update(Request $request)
    {
        \Log::info('Update method called with data:', $request->all());
        $id = $request->product_id;
        try {
            // Xác thực dữ liệu
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'category_id' => 'required|integer',
                'gender' => 'required|integer',
                'short_description' => 'required|string',
                'description' => 'required|string',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Hình ảnh hợp lệ
                'attributes' => 'required|array',
                'attributes.*.name' => 'required|string',
                'attributes.*.value_id' => 'required|integer',
                'product_variants' => 'required|array',
                'product_variants.*.size' => 'required|integer',
                'product_variants.*.price' => 'required|integer',
                'product_variants.*.discount' => 'nullable|integer',
                'product_variants.*.quantity' => 'required|integer',
            ]);
    
            // Thực hiện logic cập nhật sản phẩm nếu dữ liệu hợp lệ
            $product = $this->productService->editProduct($id, $validatedData);
    
            return response()->json(['message' => 'Product updated successfully'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }
    
    public function delete(Request $request){
        $this->productService->deleteProduct($request->id);
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

    //Thêm value của attribute
    public function addNewValue(Request $request){
        $data = $request->json()->all();

        $attribute_id = $data['attribute_id'] ?? null;
        $value = $data['value'] ?? null;

        if (!$attribute_id || !$value) {
            return response()->json(['message' => 'Dữ liệu không hợp lệ!'], 400);
        }


       try {
        $rp =  $this->attributeValueService->addNewValue($data);
            return response()->json(['message' => 'Value created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    //get product by type
    public function getProductByType(Request $request)
    {
        $products = $this->productService->getProductByType($request->type);
        return response()->json($products);
    }


    
}
