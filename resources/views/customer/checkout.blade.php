@extends('customer.layout')

@section('page_content')
<div class="main-content main-content-checkout">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index-2.html">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            Thanh toán
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h3 class="custom_blog_title">
            Thanh toán
        </h3>
        <div class="checkout-wrapp">
            <div class="shipping-address-form-wrapp">
                <div class="shipping-address-form  checkout-form">
                    <div class="row-col-1 row-col">
                        <div class="shipping-address">
                            <h3 class="title-form">
                                Thông tin giao hàng
                            </h3>
                            <p class="form-row form-row-first">
                                <label class="text">Họ tên</label>
                                <input title="first" type="text" class="input-text" id="name" required>
                            </p>
                            <p class="form-row form-row-last">
                                <label class="text">Số điện thoại</label>
                                <input title="last" type="text" class="input-text" id="phone" required>
                            </p>
                            <p class="form-row forn-row-col forn-row-col-1">
                                <label class="text">Tỉnh/Thành phố</label>
                                <select id="province" class="chosen-select" tabindex="1" >
                                </select>
                            </p>
                            <p class="form-row forn-row-col forn-row-col-2">
                                <label class="text">Quận/Huyện</label>
                                <select id="district" class="chosen-select" tabindex="1" data-placeholder="Quận/Huyện">
                                </select>
                            </p>
                            <p class="form-row forn-row-col forn-row-col-3">
                                <label class="text">Phường/Xã</label>
                                <select id="ward" class="chosen-select" tabindex="1" data-placeholder="Phường/Xã">
                                </select>
                            </p>
                            <p class="form-row form-row-first">
                                <label class="text">Địa chỉ chi tiết</label>
                                <input title="address" type="text" class="input-text" id="detail_address" required>
                            </p>
                            <p class="form-row form-row-last">
                                <label class="text">Ghi chú</label>
                                <input title="address" type="text" class="input-text" id="note">
                            </p>
                            <p class="form-row forn-row-col forn-row-col-1">
                                <label class="text">Phương thức thanh toán</label>
                                <select id="payment_method" data-placeholder="Payment Method" class="chosen-select" tabindex="1">
                                    <option value="Cash">Thanh toán khi nhận</option>
                                    <option value="Online">Thanh toán trực tuyến</option>
                                </select>
                            </p>
                            
                        </div>
                    </div>
                    <div class="row-col-2 row-col">
                        <div class="your-order">
                            <h3 class="title-form">
                                Đơn hàng
                            </h3>
                            <ul class="list-product-order" id="order-detail">
                                <li class="product-item-order">
                                    <div class="product-thumb">
                                        <a href="#">
                                            <img src="https://placehold.co/100x100" alt="img">
                                        </a>
                                    </div>
                                    <div class="product-order-inner">
                                        <h5 class="product-name">
                                            <a href="#">Product</a>
                                        </h5>
                                        <span class="attributes-select attributes-color">Black,</span>
                                        <span class="attributes-select attributes-size">XXL</span>
                                        <div class="price">
                                            $45
                                            <span class="count">x1</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item-order">
                                    <div class="product-thumb">
                                        <a href="#">
                                            <img src="https://placehold.co/100x100" alt="img">
                                        </a>
                                    </div>
                                    <div class="product-order-inner">
                                        <h5 class="product-name">
                                            <a href="#">Product</a>
                                        </h5>
                                        <span class="attributes-select attributes-color">Black,</span>
                                        <span class="attributes-select attributes-size">XXL</span>
                                        <div class="price">
                                            $45
                                            <span class="count">x1</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="order-total">
									<span class="title">
										Tổng:
									</span>
                                <span class="total-price" id="total-price">
										
									</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="button button-payment">Đặt hàng</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
    <script src="{{asset('customer/page/js/api.js')}}"></script>
    <script src="{{asset('customer/page/js/checkout.js')}}"></script>
@endsection