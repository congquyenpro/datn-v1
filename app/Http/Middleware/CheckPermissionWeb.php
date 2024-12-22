<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissionWeb
{
    public function handle($request, Closure $next, $permission) {
        if (!auth()->user() || !auth()->user()->hasPermission($permission)) {
            // Trả về view lỗi hoặc redirect
            return redirect()->route('error.page')->with('error', 'Bạn không có quyền truy cập trang này.');
        }
        //Kiểm tra nếu tài khoản đang đăng nhập bị khóa (status =0) thì không cho phép truy cập, logout và redirect về trang login
        if (auth()->user()->status == 0) {
            return redirect()->route('error.page')->with('error', 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên để biết thêm chi tiết.');
        }       
        return $next($request);
    }
}
