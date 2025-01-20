<?php 
namespace App\Services;
use App\Repositories\OrderRepository;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;

class SettingService {
    private $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    //Get user order list
    public function getCustomerOrderList($customer_type){
        $list = $this->orderRepository->getCustomerOrderList($customer_type);
        return $list;
    }
    //Get user detail
    public function getUserDetail($id){
        $user = $this->orderRepository->getCustomerDetail($id);
        return $user;
    }

    //Set user status
    public function setUserStatus($user_id, $status){
        $user = User::find($user_id)->update(['status' => $status]);
        return $user;
    }

    //Get all orders of user detail
    public function getUserOrderDetail($id){
        $order = $this->orderRepository->getUserOrderDetail($id);
        return $order;
    }


    //Cấu hình hệ thống
    public function getContactConfig(){
        // Lấy dữ liệu từ cơ sở dữ liệu
        $contactConfig = DB::table('configs')->where('type', 'contact')->first();

        // Giả sử giá trị trong cột 'value' là một chuỗi JSON
        if ($contactConfig) {
            // Giải mã JSON thành mảng
            $contactData = json_decode($contactConfig->value, true);

            // Tạo mảng data chứa các thông tin
            $data = [
                'facebook_name' => $contactData['facebook-name'] ?? null,
                'facebook_url' => $contactData['facebook-url'] ?? null,
                'phone' => $contactData['phone'] ?? null,
                'email' => $contactData['email'] ?? null,
                'address' => $contactData['address'] ?? null,
                'zalo' => $contactData['Zalo'] ?? null,
            ];

            return $data;

        } else {
            return null;
        }

    }
    public function setContactConfig($request)
    {
        // Xác định các trường cần cập nhật
        $validatedData = $request->validate([
            'facebook_name' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',
            'zalo' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);
    
        // Lấy bản ghi cấu hình liên hệ hiện tại
        $contactConfig = DB::table('configs')->where('type', 'contact')->first();
    
        // Kiểm tra nếu bản ghi tồn tại
        if ($contactConfig) {
            // Cập nhật bản ghi với giá trị mới
            DB::table('configs')
                ->where('type', 'contact')
                ->update([
                    'value' => json_encode([
                        'facebook-name' => $validatedData['facebook_name'] ?? $contactConfig->value['facebook-name'],
                        'facebook-url' => $validatedData['facebook_url'] ?? $contactConfig->value['facebook-url'],
                        'phone' => $validatedData['phone'] ?? $contactConfig->value['phone'],
                        'Zalo' => $validatedData['zalo'] ?? $contactConfig->value['Zalo'],
                        'email' => $validatedData['email'] ?? $contactConfig->value['email'],
                        'address' => $validatedData['address'] ?? $contactConfig->value['address'],
                    ])
                ]);
    
            // Trả về thông báo thành công
            return redirect()->back()->with('success', 'Thông tin liên hệ đã được cập nhật thành công.');
        } else {
            // Trường hợp không tìm thấy bản ghi
            return redirect()->back()->with('error', 'Không tìm thấy thông tin cấu hình liên hệ để cập nhật.');
        }
    }

    public function getShippingConfig()
    {
        // Lấy bản ghi có type = 'shipping-partner'
        $shippingConfig = DB::table('configs')->where('type', 'shipping-partner')->first();
    
        // Kiểm tra nếu bản ghi tồn tại và cột 'value' có dữ liệu
        if ($shippingConfig && !empty($shippingConfig->value)) {
            // Giải mã JSON thành mảng
            $shippingData = json_decode($shippingConfig->value, true);
    
            // Kiểm tra nếu dữ liệu giải mã đúng
            if (json_last_error() == JSON_ERROR_NONE) {
                // Trả về dữ liệu đã giải mã (mảng các đơn vị vận chuyển)
                return $shippingData;
            } else {
                // Nếu dữ liệu JSON không hợp lệ
                return ['error' => 'Dữ liệu JSON không hợp lệ'];
            }
        }
    
        // Trường hợp không có dữ liệu
        return null;
    }
    public function setShippingConfig($validatedData)
    {
        // Fetch the current shipping configuration from the database
        $shippingConfig = DB::table('configs')->where('type', 'shipping-partner')->first();

        // If shipping configuration exists, update it
        if ($shippingConfig) {
            DB::table('configs')
                ->where('type', 'shipping-partner')
                ->update([
                    'value' => json_encode([
                        [
                            'code' => 'GHN',
                            'name' => 'Giao Hàng Nhanh',
                            'status' => true,
                            'detail' => $validatedData['shop_id'],
                            'token' => $validatedData['token'],
                        ]
                    ])
                ]);
            return true;
        }

        // If no shipping configuration exists, return false
        return false;
    }

    public function getNotificationConfig()
    {
        // Fetch the notification configuration from the database
        $notificationConfig = DB::table('configs')->where('type', 'notification')->first();

        // If the configuration exists, decode the JSON value
        if ($notificationConfig) {
            $notificationData = json_decode($notificationConfig->value, true);

            // Check if the JSON value is valid
            if (json_last_error() == JSON_ERROR_NONE) {
                return $notificationData;
            } else {
                return ['error' => 'Dữ liệu JSON không hợp lệ'];

            }
        }

        // Return null if no configuration is found
        return null;
    }
    public function setNotificationConfig($validatedData)
    {
        // Create an array to represent the notification configuration
        $notificationConfig = [
            [
                'name' => 'order-noti',
                'chat_id' => $validatedData['order-chat-id'],
                'token' => $validatedData['order-token'] ?? null,
            ],
            [
                'name' => 'payment-noti',
                'chat_id' => $validatedData['payment-chat-id'],
                'token' => $validatedData['payment-token'] ?? null,
            ]
        ];

        // Encode the array as JSON and update it in the database
        return DB::table('configs')
            ->where('type', 'notification')
            ->update([
                'value' => json_encode($notificationConfig),
            ]);
    }

    //Template setting
    public function templateConfig($type, $name, $value)
    {
        switch ($type) {
            case 'banner':
                // Kiểm tra nếu $value là một đối tượng file hợp lệ
                if ($value instanceof \Illuminate\Http\UploadedFile && $value->isValid() && in_array($value->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                    // Tạo tên file và di chuyển ảnh vào thư mục public/images/banner
                    $fileName = time() . '.' . $value->getClientOriginalExtension();
                    $imagePath = 'images/banner/' . $fileName; // Đường dẫn tương đối
        
                    // Di chuyển ảnh vào thư mục public/images/banner
                    $value->move(public_path('images/banner'), $fileName);
        
                    // Cập nhật hoặc tạo mới bản ghi trong bảng 'configs'
                    DB::table('configs')->updateOrInsert(
                        ['type' => $type, 'name' => $name], // Điều kiện tìm bản ghi
                        ['value' => '/' . $imagePath] // Cập nhật hoặc thêm giá trị với đường dẫn ảnh
                    );
        
                    return '/' . $imagePath; // Trả về đường dẫn ảnh
                } elseif (is_string($value)) {
                    // Nếu value là chuỗi (ví dụ cho trường hợp 'slogan')
                    DB::table('configs')->updateOrInsert(
                        ['type' => $type, 'name' => $name], // Điều kiện tìm bản ghi
                        ['value' => $value] // Cập nhật hoặc thêm giá trị
                    );
                }
                break;
    
            case 'slogan':
                // Cập nhật hoặc tạo mới bản ghi trong bảng 'configs' cho slogan
                DB::table('configs')->updateOrInsert(
                    ['type' => $type, 'name' => $name], // Điều kiện tìm bản ghi
                    ['value' => $value] // Cập nhật hoặc thêm giá trị
                );
                break;
        }
    }
    public function queryTemplateConfig($type, $name)
    {
        // Lấy bản ghi cấu hình từ bảng 'configs'
        $config = DB::table('configs')->where('type', $type)->where('name', $name)->first();
    
        // Kiểm tra nếu bản ghi tồn tại
        if ($config) {
            // Trả về giá trị cấu hình
            return $config->value;
        }
    
        // Trường hợp không tìm thấy bản ghi
        return '';
    }
    public function getTemplateConfig(){
        $data = [
            'slogan' => $this->queryTemplateConfig('slogan', 'slogan'),
            'banner' => $this->queryTemplateConfig('banner', 'banner'),
            'contact' => $this->queryTemplateConfig('contact', 'Thông tin liên hệ'),
            'logo' => $this->queryTemplateConfig('logo', 'Logo'),
        ];
        return $data;
    }
    
    
    
    
    


  

}