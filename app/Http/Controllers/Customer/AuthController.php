<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;



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
            return back()->with('error', 'Old password is incorrect.');
        }
        $user->password = bcrypt($request->new_password);
        $user->save();
        return back()->with('success', 'Change password successfully');
    }


    /* Recover password */
    public function forgotPassword(){
        if (Auth::check()) {
            return redirect()->route('customer.home');
        }
        return view('customer.auth.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        // Tạo token và lưu vào bảng `password_resets`
        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );
        //lấy ra tên người dùng
        $user_name = $user->name;
        $image = 'http://127.0.0.1:8000/assets/images/avatars/thumb-3.jpg';

        // Gửi email reset mật khẩu
        $resetLink = url('/password/reset/' . $token . '?email=' . urlencode($request->email));
        try {
            Mail::send('customer.auth.forgot-mail', ['link' => $resetLink, 'user_name' => $user_name, 'image' => $image], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
/*             Mail::send('emails.password_reset', ['link' => $resetLink, 'user_name' => $user_name], function ($message) use ($request, $image) {
                $message->to($request->email);
                $message->subject('Reset Password');
                $message->attach($image); // Đính kèm ảnh từ URL
            }); */
        
            return back()->with('status', 'Liên kết đặt lại mật khẩu đã được gửi đến email của bạn!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
    public function showResetForm(Request $request, $token)
    {
        return view('customer.auth.new-password', ['token' => $token, 'email' => $request->email]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:5',
            'token' => 'required',
        ]);

        // Xác thực token từ bảng `password_resets`
        $reset = DB::table('password_resets')->where([
            ['email', $request->email],
            ['created_at', '>=', now()->subHours(2)], // Token chỉ hợp lệ trong 2 giờ
        ])->first();

        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['email' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        // Cập nhật mật khẩu mới
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        // Xóa token reset mật khẩu
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->route('customer.auth.login')->with('status', 'Mật khẩu đã được cập nhật!');
    }








    
}
