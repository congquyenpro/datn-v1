<?php

namespace App\Http\Controllers\Manager\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HelperService;
use App\Services\SettingService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    private $helperService;
    private $settingService;
    public function __construct(HelperService $helperService, SettingService $settingService){
        $this->helperService = $helperService;
        $this->settingService = $settingService;
    }
    public function index(){
        $contactConfig = $this->settingService->getContactConfig();
        $shippingConfig = $this->settingService->getShippingConfig();
        $notiConfig = $this->settingService->getNotificationConfig();
        $templateConfig = $this->settingService->getTemplateConfig();
        //dd($contactConfig);
        //dd($templateConfig);
        return view('manager.system.config.layout', compact('contactConfig', 'shippingConfig', 'notiConfig', 'templateConfig'));

    }

    //Cấu hình hệ thống
    public function getConfigs(){
        
    }
    public function setContactConfig(Request $request){
        try{
            $this->settingService->setContactConfig($request);
            return redirect()->route('manager.config')->with('success', 'Cập nhật cấu hình thành công');
        }catch(\Exception $e){
            return redirect()->route('manager.config')->with('error', 'Cập nhật cấu hình thất bại');
        }
    }

    public function setShippingConfig(Request $request)
    {
        try {
            // Validate input fields
            $validatedData = $request->validate([
                'shop_id' => 'required',
                'token' => 'required',
                'verify_code' => 'required',
            ]);
    
            // Fetch the hashed verification code from the database
            $verify_code = DB::table('configs')->where('type', 'verify_code')->first();
            
            if ($verify_code) {
                // Compare the entered verification code with the stored one
                if (!Hash::check($validatedData['verify_code'], $verify_code->value)) {
                    // Validation failed, add error and return
                    return redirect()->route('manager.config')
                        ->withErrors(['verify_code' => 'Mã xác nhận không chính xác'])
                        ->withInput();
                }
            } else {
                return redirect()->route('manager.config')->with('error', 'Không tìm thấy mã xác nhận trong hệ thống.');
            }
    
            // Delegate to SettingService to update the shipping configuration
            $updateStatus = $this->settingService->setShippingConfig($validatedData);
    
            if ($updateStatus) {
                return redirect()->route('manager.config')->with('success', 'Thông tin đối tác vận chuyển đã được cập nhật thành công.');
            } else {
                return redirect()->route('manager.config')->with('error', 'Không tìm thấy thông tin cấu hình vận chuyển để cập nhật.');
            }
    
        } catch (\Exception $e) {
            // Handle any errors during the process
            return redirect()->route('manager.config')->with('error', 'Cập nhật cấu hình thất bại');
        }
    }

    public function setNotificationConfig(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'order-chat-id' => 'required',

                'payment-chat-id' => 'required',

            ]);

            // Delegate to SettingService to update the notification configuration
            $updateStatus = $this->settingService->setNotificationConfig($validatedData);

            if ($updateStatus) {
                return redirect()->route('manager.config')->with('success', 'Cập nhật cấu hình thông báo thành công.');
            } else {
                return redirect()->route('manager.config')->with('error', 'Không tìm thấy thông tin cấu hình thông báo để cập nhật.');
            }
        } catch (\Exception $e) {
            // Handle any errors during the process
            return redirect()->route('manager.config')->with('error', 'Cập nhật cấu hình thông báo thất bại');
        }
    }

    

    public function sendNotification(){
        $message = "test";
        $response = null;  // Khởi tạo biến $response để đảm bảo luôn có giá trị trả về
        try {
            // Gọi phương thức sendNotification từ helperService
            $response = $this->helperService->sendNotification($message);
        } catch (\Exception $e) {

            \Log::error('Notification error: ' . $e->getMessage()); 

/*             $response = [
                'status' => 'error',
                'message' => 'An error occurred while sending the notification.'
            ]; */

        } finally {
            // Trả về phản hồi, bất kể lỗi hay không
            return $response;
        }
    }


    public function setTemplateConfig($type, $name, Request $request){
        if ($request->hasFile('value') && $request->file('value')->isValid()) {
            // Lấy file ảnh từ request
            $image = $request->file('value');
            
            // Tạo tên ảnh duy nhất
            $imageName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
    
            // Kiểm tra và tạo thư mục nếu không tồn tại
            $directory = public_path('images');
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true); // Tạo thư mục nếu chưa tồn tại
            }
    
            // Di chuyển và lưu ảnh vào thư mục 'public/images'
            $path = $image->move($directory, $imageName);
    
            // Lưu đường dẫn ảnh vào cơ sở dữ liệu (đảm bảo chỉ lưu đường dẫn tương đối)
            $value = 'images/' . $imageName;
        }else{
            $value = $request->input('value');
        }

        try {
            $this->settingService->templateConfig($type, $name, $value);
            return redirect()->route('manager.config')->with('success', 'Cập nhật cấu hình thành công');
        } catch (\Exception $e) {
            return redirect()->route('manager.config')->with('error', 'Cập nhật cấu hình thất bại');
        }
    }

    
}
