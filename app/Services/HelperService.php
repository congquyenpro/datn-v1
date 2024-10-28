<?php 

namespace App\Services;
use Illuminate\Support\Facades\Http;



class HelperService
{
    protected $token = 'a26e2748-971a-11ee-b1d4-92b443b7a897';

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


    
}
