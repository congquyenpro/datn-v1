@extends('manager.layout')

@section('page_title', 'Cấu hình')

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Cài đặt hệ thống</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4>Lưu ý khi cấu hình</h4>
                    <div id="doisoat-content" class="font-size-16">

                    </div>
                    {{-- Thông báo các lỗi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="m-l-5">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- Thông báo thành công --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            <ul class="nav nav-tabs nav-justified" id="myTabJustified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="template-tab-justified" data-toggle="tab" href="#template-justified" role="tab" aria-controls="template-justified" aria-selected="true">Giao diện</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab-justified" data-toggle="tab" href="#contact-justified" role="tab" aria-controls="contact-justified" aria-selected="false">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notification-tab-justified" data-toggle="tab" href="#notification-justified" role="tab" aria-controls="notification-justified" aria-selected="false">Thông báo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#profile-justified" role="tab" aria-controls="profile-justified" aria-selected="false">Đơn vị vận chuyển</a>
                </li>
{{--                 <li class="nav-item">
                    <a class="nav-link" id="home-tab-justified" data-toggle="tab" href="#home-justified" role="tab" aria-controls="home-justified" aria-selected="true">Đóng gói</a>
                </li> --}}
            </ul>
            <div class="tab-content m-t-15" id="myTabContentJustified">
                <div class="tab-pane fade show active" id="template-justified" role="tabpanel" aria-labelledby="template-tab-justified">
                    @include('manager.system.config.template')
                </div>
                <div class="tab-pane fade " id="home-justified" role="tabpanel" aria-labelledby="home-tab-justified">
                    @include('manager.system.config.shipping')
                </div>
                <div class="tab-pane fade" id="notification-justified" role="tabpanel" aria-labelledby="notification-tab-justified">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Kênh thông báo</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('manager.config.noti')}}" method="POST">
                                        @csrf
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-h-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1)">
                                                            <i class="anticon anticon-notification"></i>
                                                        </div>
                                                        <div class="font-size-15 font-weight-semibold m-l-15">Telegram: Thông báo đơn hàng mới</div>
                                                    </div>
                                                    <div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="order-chat-id" placeholder="Chat id" value="{{$notiConfig[0]['chat_id']}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="order-token"  placeholder="Token" disabled>
                                                        </div>
                                                        <input type="hidden" class="form-control" name="name" value="order-noti" >
                                                    </div>
                                                </div>
                                            </li>
                    
                                            <li class="list-group-item p-h-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1)">
                                                            <i class="anticon anticon-notification"></i>
                                                        </div>
                                                        <div class="font-size-15 font-weight-semibold m-l-15">Telegram: Thông báo giao dịch</div>
                                                    </div>
                                                    <div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="payment-chat-id" placeholder="Chat id" value="{{$notiConfig[1]['chat_id']}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="payment-token"  placeholder="Token" disabled>
                                                        </div>
                                                        <input type="hidden" class="form-control" name="name" value="payment-noti" >
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="text-center float-right mt-3">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab-justified">
                    @include('manager.system.config.dvvc')
                </div>
                <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab-justified">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Thông tin liên hệ</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('manager.config.contact')}}" method="POST">
                                        @csrf
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-h-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1)">
                                                            <i class="anticon anticon-facebook"></i>
                                                        </div>
                                                        <div class="font-size-15 font-weight-semibold m-l-15">Facebook</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-group m-r-5 m-b-5">
                                                            <input type="text" class="form-control" id="facebook_name" name="facebook_name" placeholder="Tên facebook" value="{{$contactConfig['facebook_name']}}" required>
                                                        </div>
                                                        <div class="form-group m-b-5">
                                                            <input type="text" class="form-control" id="facebook_url" name="facebook_url" placeholder="Url" value="{{$contactConfig['facebook_url']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                    
                                            <li class="list-group-item p-h-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1)">
                                                            <i class="anticon anticon-phone"></i>
                                                        </div>
                                                        <div class="font-size-15 font-weight-semibold m-l-15">Phone</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{$contactConfig['phone']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                    
                                            <li class="list-group-item p-h-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1)">
                                                            <i class="anticon anticon-phone"></i>
                                                        </div>
                                                        <div class="font-size-15 font-weight-semibold m-l-15">Zalo</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="zalo" name="zalo" placeholder="Số Zalo" value="{{$contactConfig['zalo']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                    
                                            <li class="list-group-item p-h-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1)">
                                                            <i class="anticon anticon-contacts"></i>
                                                        </div>
                                                        <div class="font-size-15 font-weight-semibold m-l-15">Email</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$contactConfig['email']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                    
                                            <li class="list-group-item p-h-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1)">
                                                            <i class="anticon anticon-contacts"></i>
                                                        </div>
                                                        <div class="font-size-15 font-weight-semibold m-l-15">Address</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{$contactConfig['address']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="text-center float-right mt-3">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
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