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


}
