<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;


class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function login(){
        if (Auth::check()) {
            return redirect()->route('customer.home');
        }
        return view('customer.auth.login');
    }
    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Đăng nhập thành công, chuyển hướng đến trang dashboard
            return redirect()->route('customer.home'); // Chuyển đến trang admin nếu là admin
        }

        // Nếu đăng nhập không thành công
        return back()->withErrors([
            'email' => 'Incorrect email or password.',
        ]);
    }
    
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('customer.home');
    }

    public function register(){
        return view('customer.auth.register');
    }

    public function postRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'agree_policy' => 'accepted',
        ]);
        
        $data = $request->only(['name', 'email', 'password']);

        /* Xử lý ngoại lệ */
        try {
            $user = $this->userService->createUser($data);
            Auth::login($user);
            return redirect()->route('customer.home');
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Email already exists.',
            ]);
        }
    }
    








    
}
