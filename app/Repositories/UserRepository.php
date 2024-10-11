<?php

namespace App\Repositories;

use App\Contracts\Repositories\IBaseRepository;
use Illuminate\Database\Eloquent\Model;
use DB;


class UserRepository extends BaseRepository implements IBaseRepository
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getAllProfiles()
    {
        //binding
        $query = 'SELECT u.id, u.avatar, u.name AS profile_name, u2.name as manager_name, u.created_at, u.status
        FROM users AS u
        left join approval as ap
        on u.id = ap.profile_id 
        left join users as u2
        on ap.manager_id = u2.id 
        WHERE u.group_id != 1 OR u.group_id IS NULL;';
        $result = DB::select($query);
        return $result;
    }

}