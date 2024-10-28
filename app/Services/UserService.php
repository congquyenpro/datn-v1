<?php 

namespace App\Services;
use App\Models\User;

use Illuminate\Support\Str;


class UserService
{


    public function __construct()
    {

    }

    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return $user;
    }


  

}
