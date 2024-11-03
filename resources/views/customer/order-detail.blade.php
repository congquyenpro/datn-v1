@extends('customer.layout')

@section('page_title', 'Chi tiết đơn hàng')

@section('page_css')
<link rel="stylesheet" href="{{asset('customer/page/css/profile.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('page_content')
<div class="main-content main-content-about">
    <div class="container" style="margin-top: 50px;">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Chi tiết đơn hàng <b>OD{{$order['id']}}</b></h4>
              <p class="card-text">{{$order['delivery_company_code']}} - {{$order['shipping_code']}} </p>
              <div class="profile-fill"></div>
              <div class="order-detail">
                <div class="row" style=" margin-top: 10px; ">
                    <div class="col-sm-12 col-md-4">
                        <div class="delivery-address">
                            <!-- <h4>Địa Chỉ Nhận Hàng</h4> -->
                            <p><strong>{{$order['name']}}</strong></p>
                            <p>{{$order['phone']}}</p>
                            @php
                                // Giả sử $order là một đối tượng stdClass
                                $formattedAddress = str_replace('/', ', ', $order['address']->address);
                            @endphp
                        <p>{{ $formattedAddress }}</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="tracking-info">
                            <ul class="tracking-list">
                                @php
                                    // Kiểm tra xem $log có phải là mảng không
                                    $logEntries = is_array($order['log']) ? array_reverse($order['log']) : [$order['log']]; // Nếu không phải là mảng, chuyển đổi thành mảng
                                @endphp
                            
                                @foreach($logEntries as $index => $entry)
                                    @php
                                        // Tách thời gian và trạng thái từ log
                                        list($time, $status) = explode(' - ', $entry);
                                    @endphp
                                    <li class="tracking-item @if($index === 0) completed @endif">
                                        <div class="tracking-time">{{ $time }}</div>
                                        <div class="tracking-status">
                                            <strong>{{ $status }}</strong>
                                            <p>Đơn hàng sẽ sớm được giao, vui lòng chú ý điện thoại</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            
                            
                        </div>
                    </div>
                </div>
              </div>
            </div>                  
            </div>
        </div>
    </div>
</div>
@endsection
