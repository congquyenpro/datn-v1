<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }
        return view('auth.login'); // Trả về view đăng nhập
    }

    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Đăng nhập thành công, chuyển hướng đến trang dashboard
            return redirect()->intended('/admin'); // Chuyển đến trang admin nếu là admin
        }

        // Nếu đăng nhập không thành công
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

}

