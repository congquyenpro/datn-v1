<?php 
namespace App\Services;
use App\Models\Product;
use App\Models\ProductSize;

class WarehouseService {
    public function getProducts() {
        return Product::get(['id', 'name', 'price']);
    }
    public function getProductSizes($product_id) {
        return ProductSize::where('product_id', $product_id)->get();
    }
}