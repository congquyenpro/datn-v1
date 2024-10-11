<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleWeb
{
    public function handle($request, Closure $next, $role) {
        if (!auth()->user() || !auth()->user()->hasRole($role)) {
            // Trả về view lỗi hoặc redirect
            return redirect()->route('error.page')->with('error', 'Bạn không có quyền truy cập trang này.');
        }
        return $next($request);
    }
}
