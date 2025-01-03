@extends('customer.layout')

@section('page_content')
<div class="main-content main-content-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="/">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            Đăng nhập
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">
                        Đăng nhập
                    </h3>
                    <div class="customer_login">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="login-item">
                                    <h5 class="title-login">Đăng nhập</h5>
                                    <form class="login" method="POST" action="{{route('customer.auth.postLogin')}}">
                                        @csrf
{{--                                         <div class="social-account">
                                            <h6 class="title-social">Đăng nhập bằng</h6>
                                            <a href="#" class="mxh-item facebook">
                                                <i class="icon fa fa-facebook-square" aria-hidden="true"></i>
                                                <span class="text">FACEBOOK</span>
                                            </a>
                                            <a href="#" class="mxh-item twitter">
                                                <i class="icon fa fa-twitter" aria-hidden="true"></i>
                                                <span class="text">GMAIL</span>
                                            </a>
                                        </div> --}}
                                        <p class="form-row form-row-wide">
                                            <label class="text">Email</label>
                                            <input title="username" type="text" class="input-text" name="email">
                                        </p>
                                        <p class="form-row form-row-wide">
                                            <label class="text">Mật khẩu</label>
                                            <input title="password" type="password" class="input-text" name="password">
                                        </p>
                                        <p class="lost_password">
                                            <span class="inline">
                                                <input type="checkbox" id="cb1">
                                                <label for="cb1" class="label-text">Ghi nhớ</label>
                                            </span>
                                            <a href="{{route('customer.auth.forgot')}}" class="forgot-pw">Quên mật khẩu?</a>
                                        </p>
                                        <p class="form-row">
                                            <input type="submit" class="button-submit" value="Đăng nhập">
                    
                                        </p>
                                        <div class="form-row">
                                            <a href="{{route('customer.auth.register')}}" class="forgot-pw">Bạn chưa có tài khoản? Đăng ký ngay</a>
                                        </div>
                                                                                    <!-- Hiển thị thông báo lỗi nếu có lỗi -->
                                            @if ($errors->any())
                                                <div>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li style="color: red">{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <!-- Hiển thị thông báo thành công -->
                                            @if (session('status'))
                                                <div>{{ session('status') }}</div>
                                            @endif
                                    </form>
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