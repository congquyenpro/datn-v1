<?php

namespace App\Repositories;

use App\Contracts\Repositories\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    public function exists($slug)
    {
        return $this->model->where('slug', $slug)->exists();
    }

    public function delete($id)
    {
        // Tìm danh mục theo ID
        $category = $this->model->find($id);
    
        if (!$category) {
            return false;  // Nếu không tìm thấy danh mục, trả về false
        }
    
        // Kiểm tra xem danh mục có ít nhất một sản phẩm không
        if ($category->products()->exists()) {
            // Trả về false nếu danh mục có sản phẩm
            return 'Danh mục này có sản phẩm, không thể xóa!';
        }
    
        // Nếu không có sản phẩm, tiến hành xóa danh mục
        return $category->delete();
    }
    
    


}
