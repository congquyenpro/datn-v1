@extends('customer.layout')

@section('page_content')
<div class="main-content main-content-checkout">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="/">Home</a>
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
            <div class="end-checkout-wrapp">
                <div class="end-checkout checkout-form">
                    <div class="icon">
                    </div>
                    <h3 class="title-checkend">
                        Đặt hàng thành công! Mã đơn hàng <a href="/order-detail">{{$orderId}}</a>
                    </h3>
                    <div class="sub-title">
                        Cảm ơn quý khách đã mua hàng tại cửa hàng của chúng tôi. Chúng tôi sẽ liên hệ với quý khách trong thời gian sớm nhất.
                    </div>
                    <h3 class="title-checkend"><a href="/order-detail?order_id={{$orderId}}">Theo dõi đơn hàng <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    </a></h3>
                    <a href="#" class="button btn-return">Return to Store</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')

@endsection