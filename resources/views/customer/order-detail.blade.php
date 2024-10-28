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
              <h4 class="card-title">Chi tiết đơn hàng <b>OD2888</b></h4>
              <p class="card-text">SPX Express - SPXVN046726188888</p>
              <div class="profile-fill"></div>
              <div class="order-detail">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="delivery-address">
                            <!-- <h4>Địa Chỉ Nhận Hàng</h4> -->
                            <p><strong>Nguyễn Quyền</strong></p>
                            <p>(+84) 888666888</p>
                            <p>66 Nguyễn Trãi, Thanh Xuân, Hà Nội</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="tracking-info">
                            <ul class="tracking-list">
                                <li class="tracking-item completed">
                                    <div class="tracking-time">08:18 04-09-2024</div>
                                    <div class="tracking-status">
                                        <strong>Đã giao</strong>
                                        <p>Đơn hàng sẽ sớm được giao, vui lòng chú ý điện thoại</p>
                                    </div>
                                </li>
                                <li class="tracking-item">
                                    <div class="tracking-time">08:18 04-09-2024</div>
                                    <div class="tracking-status">
                                        <strong>Đang vận chuyển</strong>
                                        <p>Đơn hàng sẽ sớm được giao, vui lòng chú ý điện thoại</p>
                                    </div>
                                </li>
                                <li class="tracking-item">
                                    <div class="tracking-time">08:18 04-09-2024</div>
                                    <div class="tracking-status">
                                        <strong>Đang vận chuyển</strong>
                                        <p>Đơn hàng sẽ sớm được giao, vui lòng chú ý điện thoại</p>
                                    </div>
                                </li>
                                <li class="tracking-item">
                                    <div class="tracking-time">08:18 04-09-2024</div>
                                    <div class="tracking-status">
                                        <strong>Đã xác nhận</strong>
                                        <p>Đơn hàng sẽ sớm được giao, vui lòng chú ý điện thoại</p>
                                    </div>
                                </li>
                                <li class="tracking-item">
                                    <div class="tracking-time">08:18 04-09-2024</div>
                                    <div class="tracking-status">
                                        <strong>Đặt thành công</strong>
                                        <p>Đơn hàng sẽ sớm được giao, vui lòng chú ý điện thoại</p>
                                    </div>
                                </li>

                                <!-- Add more list items as needed -->
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
