<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Lấy tất cả vai trò và các quyền liên quan
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        
        // Không cần lấy người dùng đăng nhập ở đây vì bạn đang gán quyền cho role
        return view('roles.index', compact('roles', 'permissions'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'array'
        ]);

        // Create a new role
        $role = Role::create(['name' => $request->name]);

        // Attach permissions
        if ($request->permissions) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->back()->with('success', 'Role created successfully!');
    }

    public function assignPermissions(Request $request, $roleId)
    {
        // Lấy vai trò dựa trên ID
        $role = Role::findOrFail($roleId);
        
        // Gán các quyền đã chọn cho role
        $role->permissions()->sync($request->permissions);
        
        // Chuyển hướng lại với thông báo thành công
        return redirect()->back()->with('success', 'Đã gán quyền thành công!');
    }
    public function deleteRole(Request $request)
    {
        // Lấy ID vai trò từ yêu cầu
        $roleId = $request->input('role_id');
    
        // Tìm vai trò dựa trên ID và xóa nó
        $role = Role::findOrFail($roleId);
    
        // Hủy liên kết quyền trước khi xóa
        if ($role->permissions()->exists()) {
            $role->permissions()->detach();
        }
    
        // Xóa vai trò
        $role->delete();
    
        return redirect()->back()->with('success', 'Đã xóa vai trò thành công!');
    }
    
    //Update route name
    public function show($roleId)
    {
        $role = Role::findOrFail($roleId);
        return response()->json($role);
    }
    public function update(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        $role->name = $request->input('name');
        $role->save();

        return redirect()->back()->with('success', 'Tên vai trò đã được cập nhật thành công!');
    }

}
