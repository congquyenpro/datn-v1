<?php 
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Hiển thị form để quản lý role
    public function manageRoles()
    {
        $users = User::with('roles')->get(); // Lấy tất cả người dùng cùng với các role của họ
        $roles = Role::all(); // Lấy tất cả các role
    
        return view('users.manage_roles', compact('users', 'roles'));
    }
    public function getRoles(User $user)
    {
        $allRoles = Role::all(); // Lấy tất cả các role
        $currentRoles = $user->roles; // Lấy các role hiện tại của người dùng

        return response()->json([
            'allRoles' => $allRoles,
            'currentRoles' => $currentRoles,
        ]);
    }
    
    public function assignRoles(Request $request, User $user)
    {
        $user->roles()->sync($request->roles); // Gán các role đã chọn cho người dùng
    
        return redirect()->back()->with('success', 'Roles assigned successfully!');
    }
    
    public function removeRoles(Request $request, User $user)
    {
        $user->roles()->detach($request->roles); // Xóa các role đã chọn
    
        return redirect()->back()->with('success', 'Roles removed successfully!');
    }
    
    
}
