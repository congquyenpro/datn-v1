<?php

namespace App\Http\Controllers\Manager;

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

    /* Category */
    public function showCategories(){
        $data = $this->categoryService->getAll();
        return view('manager.product.categories', compact('data'));
    }
    public function addCategory(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $data = $request->only('name', 'description');
    
        try {
            $this->categoryService->create($data);
            return back()->with('success', 'Thêm danh mục thành công');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Có lỗi xảy ra!',
            ]);
        }
    }
    public function updateCategory(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $data = $request->only('name', 'description');
    
        try {
            $this->categoryService->update($request->id, $data);
            return back()->with('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Có lỗi xảy ra!',
            ]);
        }
    }
    public function deleteCategory(Request $request) {
        $request->validate([
            'id' => 'required',
        ]);
    
        try {
            $this->categoryService->delete($request->id);
            return back()->with('success', 'Xóa danh mục thành công');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Có lỗi xảy ra!',
            ]);
        }
    }    

    /* Deal */
    public function showDeals(){
        return view('manager.product.deals');
    }

    
}
