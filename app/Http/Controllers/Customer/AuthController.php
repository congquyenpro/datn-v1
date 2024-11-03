<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;
use App\Models\User;


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

    public function updateUserProfile(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'detail_address' => 'required|string|max:255',
            'gender' => 'required|string',
            'birth_year' => 'required|integer|min:1900|max:2100',
        ]);
        $data = $request->only(['name', 'email','gender','birth_year']);
        $data['address'] = [
            'provinceId' => $request->province,
            'districtId' => $request->district,
            'wardCode' => $request->ward,
            'detailAddress' => $request->detail_address,
        ];
        $data['birthday'] = $request->birth_year;


        $user = User::find(Auth::id());
        //bắt lỗi
        try {
            $user->update($data);
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Email already exists.',
            ]);
        }
        return back()->with('success', 'Update profile successfully');
    }
    
    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);
        $user = User::find(Auth::id());
        if (!password_verify($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Old password is incorrect.',
            ]);
        }
        $user->password = bcrypt($request->new_password);
        $user->save();
        return back()->with('success', 'Change password successfully');
    }








    
}
