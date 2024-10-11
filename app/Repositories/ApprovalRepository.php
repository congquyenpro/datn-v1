<?php

namespace App\Repositories;

use App\Contracts\Repositories\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

class ApprovalRepository extends BaseRepository implements IBaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}
