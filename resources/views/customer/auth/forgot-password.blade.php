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
                            Khôi phục mật khẩu
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
                                    <h5 class="title-login">Khôi phục mật khẩu</h5>
                                    <form class="register" method="POST" action="{{route('password.email')}}">
                                        @csrf
                                        <p class="form-row form-row-wide">
                                            <label class="text">Email</label>
                                            <input title="email" type="email" class="input-text" name="email" required>
                                        </p>
                                        <p class="">
                                            <input type="submit" class="button-submit" value="Cấp lại mật khẩu">
                                        </p>
                                            <!-- Hiển thị thông báo lỗi nếu có lỗi -->
                                            @if ($errors->any())
                                            <div>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
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