<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions'
        ]);

        Permission::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Permission added successfully!');
    }
    public function deletePermission(Request $request)
    {
        // Lấy mảng ID quyền từ yêu cầu
        $permissionIds = $request->input('permissions', []);
    
        // Xóa các quyền đã chọn
        foreach ($permissionIds as $permissionId) {
            $permission = Permission::findOrFail($permissionId);
    
            // Hủy liên kết quyền với các vai trò trước khi xóa
            $permission->roles()->detach();
    
            // Xóa quyền
            $permission->delete();
        }
    
        return redirect()->back()->with('success', 'Đã xóa quyền thành công!');
    }
    

}
