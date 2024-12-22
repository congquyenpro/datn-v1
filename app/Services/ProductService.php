<?php 

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Str;
use Request;


class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }
    public function getProductDetail($id)
    {
        return $this->productRepository->getProductDetail($id);
    }


    public function addNewProduct($data)
    {
        // Tạo slug từ tên sản phẩm
        $slug = Str::slug($data['product_name']);
        
        // Tạo sản phẩm trước
        $product = $this->productRepository->createProduct($data);

        // Cập nhật slug với ID sản phẩm để đảm bảo tính duy nhất
        $product->slug = $this->generateUniqueSlug($slug, $product->id);
        $product->save(); // Lưu thay đổi

        return $product;
    }

    private function generateUniqueSlug($slug, $productId)
    {
        $baseSlug = $slug;
        $count = 0;

        // Kiểm tra slug đã tồn tại chưa
        while (\App\Models\Product::where('slug', $slug)->where('id', '<>', $productId)->exists()) {
            $count++;
            $slug = "{$baseSlug}-{$count}"; // Thêm số đếm vào slug
        }

        return $slug;
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }

    public function softDeleteProduct($id)
    {
        return $this->productRepository->softDeleteProduct($id);
    }

    public function editProduct($id, $data)
    {
        // Cập nhật sản phẩm
        $product = $this->productRepository->updateProduct($id, $data);
        
        // Không cập nhật slug, chỉ cần lưu lại sản phẩm
        $product->save(); // Lưu thay đổi
        
        return $product;
    }

    //update view
    public function updateView($product_id)
    {
        $this->productRepository->updateView($id);
    }

    

    //for customer
    public function getProductByType($type)
    {
        return $this->productRepository->getProductByType($type);
    }
    public function getProductBySlug($slug)
    {
        return $this->productRepository->getProductBySlug($slug);
    }
    public function getRelatedProduct($product_id)
    {

        return $this->productRepository->getRelatedProduct($product_id);
    }

    public function getSimilarProduct($product_id)
    {
        return $this->productRepository->getSimilarProducts($product_id);
    }


    public function getCollaborativeFiltering($request)
    {
        return $this->productRepository->getCollaborativeFiltering($request);
    }

    public function getCollaborativeFiltering2($request)
    {
        return $this->productRepository->getCollaborativeFiltering2($request);
    }



    

}
