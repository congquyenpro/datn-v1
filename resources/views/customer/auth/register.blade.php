@extends('customer.layout')

@section('page_content')
<div class="main-content main-content-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index-2.html">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            Đăng ký
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">
                        Đăng ký
                    </h3>
                    <div class="customer_login">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="login-item">
                                    <h5 class="title-login">Đăng ký</h5>
                                    <form method="POST" action="{{route('customer.auth.register')}}" class="register">
                                        @csrf
                                        <p class="form-row form-row-wide">
                                            <label class="text">Họ tên</label>
                                            <input type="text" class="input-text" name="name" required>
                                        </p>
                                        <p class="form-row form-row-wide">
                                            <label class="text">Email</label>
                                            <input title="email" type="email" class="input-text" name="email" required>
                                        </p>
                                        <p class="form-row form-row-wide">
                                            <label class="text">Mật khẩu</label>
                                            <input title="name" type="text" class="input-text" required name="password">
                                        </p>
                                        <p class="form-row form-row-wide">
                                            <label class="text">Xác nhận mật khẩu</label>
                                            <input title="pass" type="password" class="input-text" required name="confirm_password">
                                        </p>
                                        <p class="form-row">
                                            <span class="inline">
                                                <input type="checkbox" id="cb2" name="agree_policy">
                                                <label for="cb2" class="label-text">Tôi đồng ý với <span>Điều khoản</span></label>
                                            </span>
                                        </p>
                                        <p class="">
                                            <input type="submit" class="button-submit" value="Đăng ký">
                                        </p>
                                        {{-- Xử lý lỗi --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
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