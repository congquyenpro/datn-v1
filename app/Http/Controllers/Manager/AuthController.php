<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        if (Auth::check()) {
            return redirect()->route('manager.home.display');
        }
        return view('manager.auth.login');
    }
    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Kiểm tra cả status xong nếu là 0 thì là disable
        $user = User::where('email', $request->email)->first();
        if ($user && $user->status == 0) {
            return back()->withErrors([
                'email' => 'Tài khoản của bạn đã bị khóa.',
            ]);
        }        
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Đăng nhập thành công, chuyển hướng đến trang dashboard
            return redirect()->route('manager.home.display'); // Chuyển đến trang admin nếu là admin
        }

        // Nếu đăng nhập không thành công
        return back()->withErrors([
            'email' => 'Incorrect email or password.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('manager.auth.login');
    }


}
