<?php 
namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;
use App\Models\Order;

use App\Services\HelperService;


class PaymentService
{
    public function __construct()
    {
        // 
    }


    //for Webhook
    public function handleWebhook(Request $request)
    {
        // Kiểm tra API Key
        $apiKey = $request->header('Authorization');
        
        if (empty($apiKey) || !preg_match('/^Apikey\s+(.+)$/', $apiKey, $matches)) {
            return response()->json(['success' => false, 'message' => 'Invalid API Key'], 403);
        }

        $receivedApiKey = $matches[1];

        // Kiểm tra xem API Key có khớp với giá trị trong file .env không
        if ($receivedApiKey !== env('SEPAY_API_KEY')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Nhận dữ liệu từ webhook
        $data = json_decode($request->getContent());

        if (!is_object($data)) {
            return response()->json(['success' => false, 'message' => 'No data'], 400);
        }

        // Khởi tạo các biến
        $gateway = $data->gateway;
        $transaction_date = $data->transactionDate;
        $account_number = $data->accountNumber;
        $sub_account = $data->subAccount;
        $transfer_type = $data->transferType;
        $transfer_amount = $data->transferAmount;
        $accumulated = $data->accumulated;
        $code = $data->code;
        $transaction_content = $data->content;
        $reference_number = $data->referenceCode;
        $body = $data->description;

        $amount_in = 0;
        $amount_out = 0;

        // Kiểm tra giao dịch tiền vào hay tiền ra
        if ($transfer_type == "in") {
            $amount_in = $transfer_amount;
        } else if ($transfer_type == "out") {
            $amount_out = $transfer_amount;
        }

        // Lưu vào cơ sở dữ liệu
        try {
            DB::table('tb_transactions')->insert([
                'gateway' => $gateway,
                'transaction_date' => $transaction_date,
                'account_number' => $account_number,
                'sub_account' => $sub_account,
                'amount_in' => $amount_in,
                'amount_out' => $amount_out,
                'accumulated' => $accumulated,
                'code' => $code,
                'transaction_content' => $transaction_content,
                'reference_number' => $reference_number,
                'body' => $body,
                'created_at' => now(),
            ]);

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            Log::error('Error inserting record: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Cannot insert record to MySQL: ' . $e->getMessage()], 500);
        }
    }

    //Get all transactions

    public function getAllTransactions()
    {
        $apiUrl = 'https://nguyencongquyen.com/payment-service/get-all.php'; 
        $apiKey = 'Apikey 6d8760b5c2523e973b920a37dae5dec3'; 
    
        // Gửi yêu cầu GET
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->withOptions([
            'verify' => false, // Bỏ qua xác thực SSL
        ])->get($apiUrl);
    
        // Kiểm tra nếu có lỗi
        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching transactions: ' . $response->body(),
            ], 500);
        }
    
        // Trả về dữ liệu
        return response()->json($response->json());
    }
    
    public function cron()
    {
        $apiUrl = 'https://nguyencongquyen.com/payment-service/get-all.php';
        $apiKey = 'Apikey 6d8760b5c2523e973b920a37dae5dec3';
    
        // Gửi yêu cầu GET
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->withOptions([
            'verify' => false, // Bỏ qua xác thực SSL
        ])->get($apiUrl);
    
        // Kiểm tra nếu có lỗi
        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching transactions: ' . $response->body(),
            ], 500);
        }
    
        // Lấy dữ liệu giao dịch
        $transactions = $response->json()['data'];
    
        // Lưu các giao dịch vào cơ sở dữ liệu
        foreach ($transactions as $data) {
            // Kiểm tra xem giao dịch đã tồn tại hay chưa
            $exists = DB::table('tb_transactions')
                ->where('transaction_content', $data['transaction_content'])
                ->exists();
    
            if (!$exists) {
                // Chèn vào cơ sở dữ liệu nếu chưa tồn tại
                DB::table('tb_transactions')->insert([
                    'gateway' => $data['gateway'],
                    'transaction_date' => $data['transaction_date'],
                    'account_number' => $data['account_number'],
                    'sub_account' => $data['sub_account'],
                    'amount_in' => $data['amount_in'],
                    'amount_out' => $data['amount_out'],
                    'accumulated' => $data['accumulated'],
                    'code' => $data['code'],
                    'transaction_content' => $data['transaction_content'],
                    'reference_number' => $data['reference_number'],
                    'body' => $data['body'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        return response()->json(['success' => true, 'message' => 'Transactions processed successfully.']);
    }

    //Giả lập giao dịch thì reference_number có thể trung nhau (=null), môi trường thực tế luôn khác nhau
    //Development: cron() và cron2() đang check giao dịch theo transaction_content
    public function cron2()
    {
        $apiUrl = 'https://nguyencongquyen.com/payment-service/get-all.php';
        $apiKey = 'Apikey 6d8760b5c2523e973b920a37dae5dec3';
    
        // Gửi yêu cầu GET
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->withOptions([
            'verify' => false, // Bỏ qua xác thực SSL
        ])->get($apiUrl);

    
        // Lấy dữ liệu giao dịch
        $transactions = $response->json()['data'];
    
        // Lưu các giao dịch vào cơ sở dữ liệu
        foreach ($transactions as $data) {
            // Kiểm tra xem giao dịch đã tồn tại hay chưa
            $exists = DB::table('tb_transactions')
                ->where('transaction_content', $data['transaction_content'])
                ->exists();
    
            if (!$exists) {
                // Chèn vào cơ sở dữ liệu nếu chưa tồn tại
                DB::table('tb_transactions')->insert([
                    'gateway' => $data['gateway'],
                    'transaction_date' => $data['transaction_date'],
                    'account_number' => $data['account_number'],
                    'sub_account' => $data['sub_account'],
                    'amount_in' => $data['amount_in'],
                    'amount_out' => $data['amount_out'],
                    'accumulated' => $data['accumulated'],
                    'code' => $data['code'],
                    'transaction_content' => $data['transaction_content'],
                    'reference_number' => $data['reference_number'],
                    'body' => $data['body'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
    

    public function createPayment($order_id)
    {
        //$order_code = $request->order_code;
        //$order_id = substr($order_code, 2);
        //$order_value = Order::find($order_id)->value('value');
        return $order_id;
    }

    public function checkPayment($order_id)
    {
        //Vì bảng payment ít hơn order => check ở payment để giảm số lần

        // Kiểm tra trạng thái thanh toán của order trong bảng Order
        $order = Order::find($order_id);
    
        if (!$order) {
            // Nếu không tìm thấy đơn hàng, trả về lỗi
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }
    
        // Lấy giá trị của đơn hàng
        $order_value = $order->value;
        $order_code = 'OD'.$order_id;
    
        // Kiểm tra trong bảng tb_transactions xem order_id có trong transaction_content không
        $transaction = DB::table('tb_transactions')
            ->where('transaction_content', 'LIKE', '%' . $order_id . '%')
            ->first();
    
        if ($transaction) {
            // Nếu tìm thấy giao dịch, kiểm tra amount_in
            if ($transaction->amount_in == $order_value) {
                // Cập nhật trạng thái thanh toán của đơn hàng
                $order->payment_status = 1;
                $order->save();
                
                // Gửi thông báo qua Telegram
                $message = 'Thanh toán thành công đơn hàng: ' . $order_code. ', số tiền: ' . number_format($order_value) . 'đ';
                $helperService = new HelperService();
                $helperService->sendPaymentNotification($message);


                return response()->json(['status' => 'successful', 'message' => 'Payment has been completed']);
            }
        }
    
        // Nếu không tìm thấy giao dịch hoặc amount_in không khớp, trả về trạng thái chưa thanh toán
        return response()->json(['status' => 'pending', 'message' => 'Payment is still pending']);
    }
    
    
}