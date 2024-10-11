<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermissionWeb
{
    public function handle($request, Closure $next, $permission) {
        if (!auth()->user() || !auth()->user()->hasPermission($permission)) {
            // Trả về view lỗi hoặc redirect
            return redirect()->route('error.page')->with('error', 'Bạn không có quyền truy cập trang này.');
        }
        return $next($request);
    }
}
