<?php

namespace App\Http\Controllers\Manager\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
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

    /* api get all */
    public function getAll(){
        $data = $this->categoryService->getAll();
        return response()->json($data);
    }



    
}
