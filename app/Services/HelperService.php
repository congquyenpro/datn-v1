<?php 

namespace App\Services;
use Illuminate\Support\Facades\Http;



class HelperService
{

    protected $token = 'a26e2748-971a-11ee-b1d4-92b443b7a897';
    private $telegram_token = 'bot8052664673:AAH_-8o4suavPMTiDzW3kAyvgxInzeh_M2w';
    private $telegram_payment_token = 'bot7598630524:AAFhETqtDU257vOgERDouiWf-bAeU30pREY';
    private $telegram_chat_id = '7041777368';
    private $telegram_chat_id_payment = '7041777368';

    /* GHN address */
    public function getProvinceList()
    {
        $url = 'https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id';
        $response = Http::withHeaders([
            'token' => $this->token,
            'Content-Type' => 'application/json',
        ])->get($url);
        return $response->json();
    }
    public function getDistrictList($province_id)
    {
        $url = 'https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id='.$province_id;
        $response = Http::withHeaders([
            'token' => $this->token,
            'Content-Type' => 'application/json',
        ])->get($url);
        return $response->json();
    }
    public function getWardList($district_id)
    {
        $url = 'https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id='.$district_id;
        $response = Http::withHeaders([
            'token' => $this->token,
            'Content-Type' => 'application/json',
        ])->get($url);
        return $response->json();
    }

    /* Telegram notification */
    public function sendNotification($message)
    {
        $url = 'https://api.telegram.org/'.$this->telegram_token.'/sendMessage';
    
        $response = Http::withOptions([
            'verify' => false,  // Tắt SSL verification
        ])->get($url, [
            'chat_id' => $this->telegram_chat_id,
            'text' => $message,
        ]);
    
        return $response->json();
    }
    public function sendPaymentNotification($message){
        $url = 'https://api.telegram.org/'.$this->telegram_payment_token.'/sendMessage';
    
        $response = Http::withOptions([
            'verify' => false,  // Tắt SSL verification
        ])->get($url, [
            'chat_id' => $this->telegram_chat_id_payment,
            'text' => $message,
        ]);
    
        return $response->json();
    }

    
}
