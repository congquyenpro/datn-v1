
@extends('customer.layout')

@section('page_title', 'Home')

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
                            About Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-about col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">About Us</h3>
                    <div class="page-main-content">
                        <div class="header-banner banner-image">
                            <div class="banner-wrap">
                                <div class="banner-header">
                                    <div class="col-lg-4 col-md-offset-7">
                                        <div class="content-inner">
                                            <h2 class="title">
                                                BKPerfume Shop<br/>
                                            </h2>
                                            <div class="sub-title">
                                                Email: contact@bkperfume.shop <br/>
                                                Phone: 0818666888 <br/>
                                                Address: Nguyen An Ninh, Hoang Mai, HN <br/>
                                                Facebook: <a href="https://www.facebook.com/" target="_blank">BKPerfume Shop</a>
                                            </div>
                                            <div class="sub-title">
                                            </div>
                                            <a href="#" class="stelina-button button">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4">
                                <div class="stelina-iconbox  layout1">
                                    <div class="iconbox-inner">
                                        <div class="icon-item">
                                            <span class="placeholder-text">01</span>
                                            <span class="icon flaticon-rocket-ship"></span>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                Fast delivery
                                            </h4>
                                            <div class="text">
                                                Enjoy fast and reliable delivery, getting your favorite perfumes in no time.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1">
                                <div class="stelina-iconbox  layout1">
                                    <div class="iconbox-inner">
                                        <div class="icon-item">
                                            <span class="placeholder-text">02</span>
                                            <span class="icon flaticon-return"></span>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                Free returns
                                            </h4>
                                            <div class="text">
                                                7 days free return if product is not as described
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1">
                                <div class="stelina-iconbox  layout1">
                                    <div class="iconbox-inner">
                                        <div class="icon-item">
                                            <span class="placeholder-text">03</span>
                                            <span class="icon flaticon-padlock"></span>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                Online Support 24/7
                                            </h4>
                                            <div class="text">
                                                We offer 24/7 online support to assist you anytime, anywhere.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="team-member">
                            <div class="row">
                                <div class="col-sm-12 border-custom">
                                    <span></span>
                                </div>
                            </div>
                            <h2 class="custom_blog_title center">
                                Testimonials
                            </h2>
                            <div class="team-member-slider nav-center owl-slick"
                                 data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}'
                                 data-responsive='[{"breakpoint":"0","settings":{"slidesToShow":1}},{"breakpoint":"480","settings":{"slidesToShow":1}},{"breakpoint":"767","settings":{"slidesToShow":2}},{"breakpoint":"991","settings":{"slidesToShow":3}},{"breakpoint":"1199","settings":{"slidesToShow":3}},{"breakpoint":"2000","settings":{"slidesToShow":3}}]'>
                                <div class="stelina-team-member">
                                    <div class="team-member-item">
                                        <div class="member_avatar">
                                            <img src="{{asset('customer/')}}/images/avatar/462577397_3823066328010106_4412044270952224597_n.jpg" alt="img" style="width: 70%;">
                                        </div>
                                        <h5 class="member_name">Mrs Lee</h5>
                                        <div class="member_position">
                                            CEO & Founder RTe
                                        </div>
                                        <div class="member_position">
                                            Mình rất hài lòng với các sản phẩm nước hoa trên website này. Mùi hương đa dạng, lưu lâu và giao hàng rất nhanh
                                        </div>
                                    </div>
                                </div>
                                <div class="stelina-team-member">
                                    <div class="team-member-item">
                                        <div class="member_avatar">
                                            <img src="{{asset('customer/')}}/images/avatar/464998688_913274214270982_177476284367870619_n.jpg" alt="img" style="width: 70%;">
                                        </div>
                                        <h5 class="member_name">Mrs Maya</h5>
                                        <div class="member_position">
                                            CEO & Founder REd
                                        </div>
                                        <div class="member_position">
                                            Dịch vụ tuyệt vời, tư vấn nhiệt tình. Sản phẩm nước hoa chất lượng, mùi hương thật sự ấn tượng
                                        </div>
                                    </div>
                                </div>
                                <div class="stelina-team-member">
                                    <div class="team-member-item">
                                        <div class="member_avatar">
                                            <img src="{{asset('customer/')}}/images/avatar/465369939_9671966462818207_388897178761895127_n.jpg" alt="img" style="width: 70%;">
                                        </div>
                                        <h5 class="member_name">Mr David</h5>
                                        <div class="member_position">
                                            CEO & Founder RTe
                                        </div>
                                        <div class="member_position">
                                            Mình rất thích cách website cung cấp thông tin chi tiết về từng loại nước hoa. Sản phẩm chất lượng, giao hàng nhanh, mình sẽ quay lại
                                        </div>
                                    </div>
                                </div>
                                <div class="stelina-team-member">
                                    <div class="team-member-item">
                                        <div class="member_avatar">
                                            <img src="{{asset('customer/')}}/images/avatar/467421078_2379953395701180_7299447538585632760_n.jpg" alt="img" style="width: 70%;">
                                        </div>
                                        <h5 class="member_name">Mr Json</h5>
                                        <div class="member_position">
                                            CEO & Founder REd
                                        </div>
                                        <div class="member_position">
                                            Mua nước hoa ở đây rất yên tâm. Sản phẩm chính hãng, giá cả hợp lý và dịch vụ chăm sóc khách hàng tuyệt vời. Mình chắc chắn sẽ tiếp tục mua sắm
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
    <script src="{{asset('customer/page/js/cart.js')}}"></script>
@endsection
