@extends('customer.layout')
@section('title', 'Profile')
@section('page_css')
<link rel="stylesheet" href="{{asset('customer/page/css/profile.css')}}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
@yield('css')
@endsection

@section('page_content')
<div class="main-content main-content-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="/">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            Profile
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-about col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">Profile</h3>
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <div class="mt-3" style=" display: flex; justify-content: center; ">      
                                    <img src="https://openseauserdata.com/files/e597b67ffc073521926db6cfd28af7ff.jpg" style="border-radius: 50%;" class="rounded-circle" alt="Cinque Terre" width="30%" height="236"> 
                                </div>
                                <div class="name" style=" display: flex; justify-content: center; padding-top: 1rem; font-weight: bold; color:#ab8e66">{{$user_info['name']}}</div>
                                <hr>
                                <div class="profile-nav" >
                                    <a href="{{route('customer.profile')}}"><i class="fa fa-user-o fa-fw" aria-hidden="true"></i>Thông tin cá nhân</a><br>
                                    <a href="{{route('customer.profile.security')}}"><i class="fa fa-lock fa-fw" aria-hidden="true"></i>Bảo mật</a><br>
                                    <a href="{{route('customer.profile.order')}}"><i class="fa fa-list fa-fw" aria-hidden="true"></i>Lịch sử mua hàng</a><br>
                                    <a href="#"><i class="fa fa-gift fa-fw" aria-hidden="true"></i>Hoa hồng</a><br>
                                    <a href="{{route('customer.auth.logout')}}"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Đăng xuất</a><br>
                                </div>
                                
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                                @yield('profile-content')


                                <br>
                                <div class="card" style="display:none">
                                    <div class="card-body">
                                      <h4 class="card-title">Chi tiết đơn hàng</h4>
                                      <p class="card-text">SPX Express - SPXVN046726188888</p>
                                      <div class="profile-fill"></div>
                                      <div class="order-detail">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <div class="delivery-address">
                                                    <!-- <h4>Địa Chỉ Nhận Hàng</h4> -->
                                                    <p><strong>Ngọc Mai</strong></p>
                                                    <p>(+84) 862260500</p>
                                                    <p>C21-2, Lê Trọng Tấn, Khu Đô Thị Geleximco, Phường Dương Nội, Quận Hà Đông, Hà Nội</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
    <script src="{{asset('customer/page/js/api.js')}}"></script>
    <script src="{{asset('customer/page/js/checkout.js')}}"></script>
    @yield('js')
@endsection