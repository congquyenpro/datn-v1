<?php 
namespace App\Services;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Str;

class ProductService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->all();
    }

    public function getById($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function create($data) {
        // Tạo slug từ name
        $data['slug'] = Str::slug($data['name']);
    
        // Kiểm tra slug duy nhất (nếu cần)
        $this->checkSlugUniqueness($data['slug']); // Tùy chọn
    
        return $this->categoryRepository->create($data);
    }
    protected function checkSlugUniqueness($slug) {
        if ($this->categoryRepository->exists($slug)) {
            // Nếu slug đã tồn tại, tạo một slug mới (có thể thêm hậu tố)
            $slug .= '-' . uniqid();
        }
        return $slug;
    }
    

    public function update($id, $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
