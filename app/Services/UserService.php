<?php 

namespace App\Services;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use DB;
use Illuminate\Support\Str;
use Request;


class UserService
{


    public function __construct()
    {

    }

    //Admin - Permission and Role
    //User
    public function getAdminUsers()
    {
        $users = User::with('roles')
        ->whereHas('roles', function ($query) {
            $query->where('role_id', '<>', 3); // Lọc ra role_id không phải là 3
        })
        ->get();

        return $users;
    }
    public function getAdminUserDetail($id)
    {
        $user = User::with('roles')->find($id);
        return $user;
    }
    public function addAdminUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->roles()->attach($data['role_id']);
        return $user;
    }

    public function updateAdminUser($data, $id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);
    
        if (!$user) {
            // Nếu không tìm thấy người dùng, trả về lỗi
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Cập nhật thông tin người dùng
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ?? $user->password, // Nếu không có mật khẩu mới, giữ nguyên mật khẩu cũ
        ]);
    
        // Đồng bộ lại vai trò của người dùng
        if (isset($data['role_id'])) {
            $user->roles()->sync([$data['role_id']]); // Cập nhật vai trò của người dùng
        }
    
        return $user;
    }
    

    public function deleteAdminUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

    /*Permission and Role */
    public function getRoles()
    {
        $roles = Role::all();
        return $roles;
    }
    public function addRole($data, $permissions)
    {
        // Thêm vai trò vào bảng roles
        $role = Role::create([
            'name' => $data['name'], // Gán tên vai trò
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        // Kiểm tra xem có quyền được truyền vào không
        if (!empty($permissions)) {
            // Gắn quyền vào vai trò, nếu có
            foreach ($permissions as $permission_id) {
                DB::table('permission_role')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id,
                ]);
            }
        }
    
        return $role;
    }
    

    public function getPermissions()
    {
        $permissions = Permission::all();
        return $permissions;
    }
    public function getPermissionsByRole()
    {
        $permissions_by_roles = Role::with('permissions')->get();
        return $permissions_by_roles;
    }
    public function getPermissionsByRoleDetail($role_id)
    {
        return DB::select('select * from permission_role where role_id = ?', [$role_id]);
    }

    public function updatePermissionsByRole($role_id)
    {
        //Chỉ cập nhật tên
        $role = Role::find($role_id);
        $role->update([
            'name' => Request::input('name'),
        ]);
        //Không cập nhật quyền
        return $role;
    }



    /* Customer */
    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return $user;
    }


  

}
