<?php

namespace App\Http\Controllers\Manager\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HelperService;

class SettingController extends Controller
{
    private $helperService;
    public function __construct(HelperService $helperService){
        $this->helperService = $helperService;
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
    
}
