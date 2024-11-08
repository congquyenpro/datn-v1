
@extends('customer.layout')

@section('page_title', 'Home')

@section('page_content')
<div>
    <div class="fullwidth-template">
        <div class="home-slider-banner">
            <div class="container">
                <div class="row10">
                    <div class="col-lg-8 silider-wrapp">
                        <div class="home-slider">
                            <div class="slider-owl owl-slick equal-container nav-center"
                                 data-slick='{"autoplay":true, "autoplaySpeed":9000, "arrows":false, "dots":true, "infinite":true, "speed":1000, "rows":1}'
                                 data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1}}]'>
                                <div class="slider-item style7">
                                    <div class="slider-inner equal-element">
                                        <div class="slider-infor">
                                            <h5 class="title-small">
                                                Sale up to 40% off!
                                            </h5>
                                            <h3 class="title-big">
                                                Spring Summer <br/>Collection
                                            </h3>
                                            <div class="price">
                                                New Price:
                                                <span class="number-price">
														$270.00
													</span>
                                            </div>
                                            <a href="#" class="button btn-shop-the-look bgroud-style">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-item style8">
                                    <div class="slider-inner equal-element">
                                        <div class="slider-infor">
                                            <h5 class="title-small">
                                                Take A perfume
                                            </h5>
                                            <h3 class="title-big">
                                                Up to 25% Off <br/>order now
                                            </h3>
                                            <div class="price">
                                                Save Price:
                                                <span class="number-price">
														$170.00
													</span>
                                            </div>
                                            <a href="#" class="button btn-shop-product">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-item style9">
                                    <div class="slider-inner equal-element">
                                        <div class="slider-infor">
                                            <h5 class="title-small">
                                                Stelina Best Collection
                                            </h5>
                                            <h3 class="title-big">
                                                A range of <br/>perfume
                                            </h3>
                                            <div class="price">
                                                New Price:
                                                <span class="number-price">
														$250.00
													</span>
                                            </div>
                                            <a href="#" class="button btn-chekout">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 banner-wrapp">
                        <div class="banner">
                            <div class="item-banner style7">
                                <div class="inner">
                                    <div class="banner-content">
                                        <h3 class="title">Pick Your <br/>Items</h3>
                                        <div class="description">
                                            Adipiscing elit curabitur senectus sem
                                        </div>
                                        <a href="{{route('customer.shop')}}" class="button btn-lets-do-it">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="banner">
                            <div class="item-banner style8">
                                <div class="inner">
                                    <div class="banner-content">
                                        <h3 class="title">Best Of<br/>Products</h3>
                                        <div class="description">
                                            Cras pulvinar loresum dolor conse
                                        </div>
                                        <span class="price">$379.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stelina-product produc-featured rows-space-65">
            <div class="container">
                <h3 class="custommenu-title-blog">
                    Deal of the day
                </h3>
                <div id="deal_of_day" class="deal-of-day-items "></div>
            </div>
        </div>
        <div class="banner-wrapp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="banner">
                            <div class="item-banner style4">
                                <div class="inner">
                                    <div class="banner-content">
                                        <h4 class="stelina-subtitle">TOP STAFF PICK</h4>
                                        <h3 class="title">Best Collection</h3>
                                        <div class="description">
                                            Proin interdum magna primis id consequat
                                        </div>
                                        <a href="#" class="button btn-shop-now">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="banner">
                            <div class="item-banner style5">
                                <div class="inner">
                                    <div class="banner-content">
                                        <h3 class="title">Maybe You’ve <br/>Earned it</h3>
                                        <span class="code">
												Use code:
												<span>
													STELINA
												</span>
												Get 25% Off for all items!
											</span>
                                        <a href="#" class="button btn-shop-now">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-wrapp rows-space-65">
            <div class="container">
                <div class="banner">
                    <div class="item-banner style17">
                        <div class="inner">
                            <div class="banner-content">
                                <h3 class="title">Collection Arrived</h3>
                                <div class="description">
                                    You have no items & Are you <br/>ready to use? come & shop with us!
                                </div>
                                <div class="banner-price">
                                    Price from:
                                    <span class="number-price">$45.00</span>
                                </div>
                                <a href="#" class="button btn-shop-now">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stelina-tabs  default rows-space-40">
            <div class="container">
                <div class="tab-head" style="margin-bottom: 20px;">
                    <ul class="tab-link">
                        <li class="active">
                            <a data-toggle="tab" aria-expanded="true" href="#bestseller">Best Selling</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" aria-expanded="true" href="#new_arrivals">New</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" aria-expanded="true" href="#top-viewed">Top Viewed</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-container">
                    <div id="bestseller" class="tab-panel active">
                        <a href="#" class="more-nav" style=" display: flex; float: right; color:#ab8e66; font-weight: bold; font-size: 18px; ">View More</a>
                        <div class="stelina-product">
                            <ul class="row list-products auto-clear equal-container product-grid">
                                <div id="best-seller-products"></div>

                            </ul>
                        </div>
                    </div>
                    <div id="new_arrivals" class="tab-panel">
                        <a href="#" class="more-nav" style=" display: flex; float: right; color:#ab8e66; font-weight: bold; font-size: 18px; ">View More</a>
                        <div class="stelina-product">
                            <ul class="row list-products auto-clear equal-container product-grid">
                                <div id="new-arrival-product"></div>

                            </ul>
                        </div>
                    </div>
                    <div id="top-viewed" class="tab-panel">
                        <a href="#" class="more-nav" style=" display: flex; float: right; color:#ab8e66; font-weight: bold; font-size: 18px; ">View More</a>
                        <div class="stelina-product">
                            <ul class="row list-products auto-clear equal-container product-grid">
                                <div id="top-viewed-product"></div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stelina-iconbox-wrapp default">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="stelina-iconbox  default">
                            <div class="iconbox-inner">
                                <div class="icon-item">
                                    <span class="icon flaticon-rocket-ship"></span>
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        Free Delivery
                                    </h4>
                                    <div class="text">
                                        Free Delivery on all order from VN <br/>with price more than $90.00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="stelina-iconbox  default">
                            <div class="iconbox-inner">
                                <div class="icon-item">
                                    <span class="icon flaticon-return"></span>
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        Money Guarantee
                                    </h4>
                                    <div class="text">
                                        30 Days money back guarantee <br/>no question asked!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="stelina-iconbox  default">
                            <div class="iconbox-inner">
                                <div class="icon-item">
                                    <span class="icon flaticon-padlock"></span>
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        Online Support 24/7
                                    </h4>
                                    <div class="text">
                                        We’re here to support to you. <br/>Let’s shopping now!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stelina-blog-wraap default">
            <div class="container">
                <h3 class="custommenu-title-blog">
                    Our Latest News
                </h3>
                <div class="stelina-blog default">
                    <div class="owl-slick equal-container nav-center"
                         data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":false, "dots":true, "infinite":true, "speed":800, "rows":1}'
                         data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":3}},{"breakpoint":"1200","settings":{"slidesToShow":3}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"768","settings":{"slidesToShow":2}},{"breakpoint":"481","settings":{"slidesToShow":1}}]'>
{{--                         <div class="stelina-blog-item equal-element layout1">
                            <div class="post-thumb">
                                <div class="video-stelina-blog">
                                    <figure>
                                        <img style=" width: 100%; height: 280px; " src="https://images.pexels.com/photos/3633850/pexels-photo-3633850.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img" width="370"
                                             height="280">
                                    </figure>
                                    <a class="quick-install" href="#" data-videosite="vimeo"
                                       data-videoid="134060140"></a>
                                </div>
                                <div class="category-blog">
                                    <ul class="list-category">
                                        <li class="category-item">
                                            <a href="#">VIDEO</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="post-item-share">
                                    <a href="#" class="icon">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                    </a>
                                    <div class="box-content">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <div class="post-date">
                                        Agust 17, 09:14 am
                                    </div>
                                    <span class="view">
											<i class="icon fa fa-eye" aria-hidden="true"></i>
											631
										</span>
                                    <span class="comment">
											<i class="icon fa fa-commenting" aria-hidden="true"></i>
											84
										</span>
                                </div>
                                <h2 class="blog-title">
                                    <a href="#">We design functional Items</a>
                                </h2>
                                <div class="main-info-post">
                                    <p class="des">
                                        Risus non porta suscipit lobortis habitasse felis, aptent
                                        interdum pretium ut.
                                    </p>
                                    <a class="readmore" href="#">Read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="stelina-blog-item equal-element layout1">
                            <div class="post-thumb">
                                <a href="#">
                                    <img src="https://placehold.co/370x280" alt="img">
                                </a>
                                <div class="category-blog">
                                    <ul class="list-category">
                                        <li class="category-item">
                                            <a href="#">Skincare</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="post-item-share">
                                    <a href="#" class="icon">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                    </a>
                                    <div class="box-content">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <div class="post-date">
                                        Agust 17, 09:14 am
                                    </div>
                                    <span class="view">
											<i class="icon fa fa-eye" aria-hidden="true"></i>
											631
										</span>
                                    <span class="comment">
											<i class="icon fa fa-commenting" aria-hidden="true"></i>
											84
										</span>
                                </div>
                                <h2 class="blog-title">
                                    <a href="#">We know that buying Items</a>
                                </h2>
                                <div class="main-info-post">
                                    <p class="des">
                                        Class integer tellus praesent at torquent cras, potenti erat fames
                                        volutpat etiam.
                                    </p>
                                    <a class="readmore" href="#">Read more</a>
                                </div>
                            </div>
                        </div> --}}
                        @foreach ($blogs as $blog)
                        <div class="stelina-blog-item equal-element layout1">
                            <div class="post-thumb">
                                <a href="/post/{{$blog->slug}}">
                                    <img src="{{$blog->image}}" alt="img" style=" width: 100%; height: 280px; " >
                                </a>
                                <div class="category-blog">
                                    <ul class="list-category">
                                        <li class="category-item">
                                            <a href="/post/{{$blog->slug}}">Nước hoa</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="post-item-share">
                                    <a href="#" class="icon">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                    </a>
                                    <div class="box-content">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <div class="post-date">
                                        {{$blog->created_at}}
                                    </div>
                                    <span class="view">
											<i class="icon fa fa-eye" aria-hidden="true"></i>
											631
										</span>
                                    <span class="comment">
											<i class="icon fa fa-commenting" aria-hidden="true"></i>
											84
										</span>
                                </div>
                                <h2 class="blog-title">
                                    <a href="/post/{{$blog->slug}}">{{$blog->title}}</a>
                                </h2>
                                <div class="main-info-post">
                                    <p class="des">
                                        {{$blog->summary}}
                                    </p>
                                    <a class="readmore" href="/post/{{$blog->slug}}">Read more</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="instagram-wrapp">
    <div>
        <h3 class="custommenu-title-blog">
            <i class="flaticon-instagram" aria-hidden="true"></i>
            Instagram Feed
        </h3>
        <div class="stelina-instagram">
            <div class="instagram owl-slick equal-container"
                 data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":false, "dots":false, "infinite":true, "speed":800, "rows":1}'
                 data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":5}},{"breakpoint":"1200","settings":{"slidesToShow":4}},{"breakpoint":"992","settings":{"slidesToShow":3}},{"breakpoint":"768","settings":{"slidesToShow":2}},{"breakpoint":"481","settings":{"slidesToShow":2}}]'>
                <div class="item-instagram">
                    <a href="#">
                        <img src="https://images.pexels.com/photos/264950/pexels-photo-264950.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img">
                    </a>
                    <span class="text">
                        <i class="icon flaticon-instagram" aria-hidden="true"></i>
			        </span>
                </div>
                <div class="item-instagram">
                    <a href="#">
                        <img src="https://images.pexels.com/photos/1961791/pexels-photo-1961791.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img">
                    </a>
                    <span class="text">
                        <i class="icon flaticon-instagram" aria-hidden="true"></i>
			        </span>
                </div>
                <div class="item-instagram">
                    <a href="#">
                        <img src="https://images.pexels.com/photos/3865676/pexels-photo-3865676.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img">
                    </a>
                    <span class="text">
                        <i class="icon flaticon-instagram" aria-hidden="true"></i>
			        </span>
                </div>
                <div class="item-instagram">
                    <a href="#">
                        <img src="https://images.pexels.com/photos/4659793/pexels-photo-4659793.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img">
                    </a>
                    <span class="text">
                        <i class="icon flaticon-instagram" aria-hidden="true"></i>
			        </span>
                </div>
                <div class="item-instagram">
                    <a href="#">
                        <img src="https://images.pexels.com/photos/3910071/pexels-photo-3910071.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img">
                    </a>
                    <span class="text">
                        <i class="icon flaticon-instagram" aria-hidden="true"></i>
			        </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
    <script src="{{asset('customer/page/js/api.js')}}"></script>
    <script src="{{asset('customer/page/js/cart.js')}}"></script>
    <script src="{{asset('customer/page/js/index.js')}}"></script>
@endsection
