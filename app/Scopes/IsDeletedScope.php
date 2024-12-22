<?php 
namespace App\Scopes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IsDeletedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Thêm điều kiện is_deleted = 0 vào tất cả các truy vấn
        $builder->where('is_deleted', 0);
    }
}
