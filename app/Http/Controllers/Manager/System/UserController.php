<?php

namespace App\Http\Controllers\Manager\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getAdminUsers();
        $all_roles = $this->userService->getRoles();
        $all_permissions = $this->userService->getPermissions();
        $permissions_by_roles = $this->userService->getPermissionsByRole();
        
        return view('manager.system.users', compact('users', 'all_roles', 'all_permissions', 'permissions_by_roles'));
    }
    public function getAdminUserDetail(Request $request)
    {
        $user_id = $request->user_id;
        $users = $this->userService->getAdminUserDetail($user_id);
        return response()->json($users);
    }
    public function update(Request $request)
    {
        // Lấy tất cả dữ liệu gửi lên từ form
        $data = $request->all();
    
        // Kiểm tra nếu có mật khẩu mới và mã hóa nó
        if (isset($data['new_password']) && !empty($data['new_password'])) {
            $data['password'] = bcrypt($data['new_password']);
        }
        try {
            // Cập nhật thông tin người dùng thông qua service
            $user = $this->userService->updateAdminUser($data, $data['user_id']);
            return response()->json([
                'message' => 'Update user successfully',
                'code' => 200,
            ]);
        } catch (\Exception $e) {
            // Nếu có lỗi, trả về thông báo lỗi
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    
    //Thêm người dùng mới
    public function store(Request $request)
    {
        $data = $request->all();
        $user = $this->userService->addAdminUser($data);
        return redirect()->route('manager.users');
    }

    //Thêm vai trò
    public function addRole(Request $request)
    {
        // Lấy tất cả dữ liệu gửi lên
        $data = $request->all();
    
        // Kiểm tra xem permission_id có phải là mảng không và không rỗng
        if (isset($data['permission_id']) && is_array($data['permission_id']) && !empty($data['permission_id'])) {
            // Nếu có quyền được chọn, thêm vào dữ liệu
            $permissions = $data['permission_id'];
        } else {
            // Nếu không có quyền nào được chọn, trả về lỗi hoặc thông báo
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một quyền');
        }
    
        // Thêm vai trò và quyền
        $role = $this->userService->addRole($data, $permissions); // Truyền permissions như một tham số riêng biệt
    
        return redirect()->route('manager.users');
    }

    //lấy quyền theo vai trò
    public function getPermissionsByRoleDetail(Request $request)
    {
        $role_id = $request->role_id;
        $permissions = $this->userService->getPermissionsByRoleDetail($role_id);
        //dd($role_id);
        return response()->json($permissions);
    }
    public function updatePermissionsByRole1(Request $request)
    {
        $role_id = $request->role_id;
        $permissions = $this->userService->updatePermissionsByRole($role_id);
        return response()->json($permissions);
    }
    
    public function updatePermissionsByRole(Request $request)
    {
        $data = $request->all();
        $role_id = $request->role_id;

        // Kiểm tra xem permission_id có phải là mảng không và không rỗng
        if (isset($data['permission_id']) && is_array($data['permission_id']) && !empty($data['permission_id'])) {
            // Nếu có quyền được chọn, thêm vào dữ liệu
            $permissions = $data['permission_id'];
        } else {
            // Nếu không có quyền nào được chọn, trả về lỗi hoặc thông báo
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một quyền');
        }
        $role = $this->userService->updatePermissionsByRole_New($role_id, $data, $permissions);
    }

}
