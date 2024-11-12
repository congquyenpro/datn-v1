<!DOCTYPE html>
<html lang="en">


<head>
    <title>@yield('page_title')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('customer/assets/images/favicon.png')}}"/>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('customer/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/js/fancybox/source/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/jquery.scrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/mobile-menu.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/fonts/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/style.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta_tags')
    @yield('page_css')

    {{-- <link rel="stylesheet" href="test.css"> --}}
</head>
<body class="home">
<header class="header style7">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <div class="header-message">
                    Welcome to our online store!
                </div>
            </div>
            <div class="top-bar-right">
                <div class="header-language">
                    <div class="stelina-language stelina-dropdown">
                        <a href="#" class="active language-toggle" data-stelina="stelina-dropdown">
									<span>
										English (USD)
									</span>
                        </a>
                        <ul class="stelina-submenu">
                            <li class="switcher-option">
                                <a href="#">
											<span>
												French (EUR)
											</span>
                                </a>
                            </li>
                            <li class="switcher-option">
                                <a href="#">
											<span>
												Japanese (JPY)
											</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="header-user-links">
                    <li>
                        @if (!auth()->check())
                            <a href="{{route('customer.auth.login')}}">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main-header">
            <div class="row">
                <div class="col-lg-3 col-sm-4 col-md-3 col-xs-7 col-ts-12 header-element">
                    <div class="logo">
                        <a href="/">
                            <img src="https://placehold.co/169x45" alt="img">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-8 col-md-6 col-xs-5 col-ts-12">
                    <div class="block-search-block">
                        <form class="form-search form-search-width-category">
                            <div class="form-content">
                                <div class="category">
                                    <select title="cate" data-placeholder="All Categories" class="chosen-select"
                                            tabindex="1">
                                        <option value="United States">Accessories</option>
                                        <option value="United Kingdom">Accents</option>
                                        <option value="Afghanistan">Desks</option>
                                        <option value="Aland Islands">Sofas</option>
                                        <option value="Albania">New Arrivals</option>
                                        <option value="Algeria">Bedroom</option>
                                    </select>
                                </div>
                                <div class="inner">
                                    <input type="text" class="input" name="s" value="" placeholder="Search here">
                                </div>
                                <button class="btn-search" type="submit">
                                    <span class="icon-search"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
                    <div class="header-control">
                        <div class="block-minicart stelina-mini-cart block-header stelina-dropdown">
                            <a href="javascript:void(0);" class="shopcart-icon" data-stelina="stelina-dropdown">
                                Cart
                                <span class="count" id="cart-count">
										0
										</span>
                            </a>
                            <div class="shopcart-description stelina-submenu">
                                <div class="content-wrap">
                                    <h3 class="title">Giỏ hàng</h3>
                                    <ul class="minicart-items" id="cart-content">
                                        <li class="product-cart mini_cart_item">
                                            <a href="#" class="product-media">
                                                <img src="{{asset('customer/assets/images/item-minicart-1.jpg')}}" alt="img">
                                            </a>
                                            <div class="product-details">
                                                <h5 class="product-name">
                                                    <a href="#">Nước hoa 1</a>
                                                </h5>
                                                <div class="variations">
                                                    <span class="attribute_size">
																<a href="#">300ml</a>
															</span>
                                                </div>
                                                <span class="product-price">
															<span class="price">
																<span>500.000₫</span>
															</span>
														</span>
                                                <span class="product-quantity">
															(x1)
														</span>
                                                <div class="product-remove">
                                                    <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-cart mini_cart_item">
                                            <a href="#" class="product-media">
                                                <img src="{{asset('customer/assets/images/item-minicart-2.jpg')}}" alt="img">
                                            </a>
                                            <div class="product-details">
                                                <h5 class="product-name">
                                                    <a href="#">Nước hoa 2</a>
                                                </h5>
                                                <div class="variations">
									
                                                    <span class="attribute_size">
																<a href="#">300ml</a>
															</span>
                                                </div>
                                                <span class="product-price">
															<span class="price">
																<span>5.000.000₫</span>
															</span>
														</span>
                                                <span class="product-quantity">
															(x1)
														</span>
                                                <div class="product-remove">
                                                    <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-cart mini_cart_item">
                                            <a href="#" class="product-media">
                                                <img src="{{asset('customer/assets/images/item-minicart-3.jpg')}}" alt="img">
                                            </a>
                                            <div class="product-details">
                                                <h5 class="product-name">
                                                    <a href="#">Nước hoa 3</a>
                                                </h5>
                                                <div class="variations">
                                                    <span class="attribute_size">
																<a href="#">300ml</a>
															</span>
                                                </div>
                                                <span class="product-price">
															<span class="price">
																<span>2.500.000₫</span>
															</span>
														</span>
                                                <span class="product-quantity">
															(x1)
														</span>
                                                <div class="product-remove">
                                                    <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="subtotal">
                                        <span class="total-title">Tổng: </span>
                                        <span class="total-price">
													<span class="Price-amount">
														8.000.000₫
													</span>
												</span>
                                    </div>
                                    <div class="actions">
                                        <a class="button button-viewcart" href="{{route('customer.cart')}}">
                                            <span>View</span>
                                        </a>
                                        <a href="{{route('customer.checkout')}}" class="button button-checkout">
                                            <span>Checkout</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-account block-header stelina-dropdown">
                            <a href="javascript:void(0);" data-stelina="stelina-dropdown">
                                <span class="flaticon-user"></span>
                            </a>
                            <div class="header-account stelina-submenu">
                                <div class="header-user-form-tabs">
                                    @if (!auth()->check())
                                        <ul class="tab-link">
                                            <li class="active">
                                                <a data-toggle="tab" aria-expanded="true" href="#header-tab-login">Login</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" aria-expanded="true" href="#header-tab-rigister">Register</a>
                                            </li>
                                        </ul>
                                        <div class="tab-container">
                                            <div id="header-tab-login" class="tab-panel active">
                                                <form method="post" class="login form-login">
                                                    <p class="form-row form-row-wide">
                                                        <input type="email" placeholder="Email" class="input-text">
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        <input type="password" class="input-text" placeholder="Password">
                                                    </p>
                                                    <p class="form-row">
                                                        <label class="form-checkbox">
                                                            <input type="checkbox" class="input-checkbox">
                                                            <span>
                                                                        Remember me
                                                                    </span>
                                                        </label>
                                                        <input type="submit" class="button" value="Login">
                                                    </p>
                                                    <p class="lost_password">
                                                        <a href="#">Lost your password?</a>
                                                    </p>
                                                </form>
                                            </div>
                                            <div id="header-tab-rigister" class="tab-panel">
                                                <form method="post" class="register form-register">
                                                    <p class="form-row form-row-wide">
                                                        <input type="email" placeholder="Email" class="input-text">
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        <input type="password" class="input-text" placeholder="Password">
                                                    </p>
                                                    <p class="form-row">
                                                        <input type="submit" class="button" value="Register">
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                    <ul class="tab-link">
                                        <li>
                                            <a href="{{route('customer.profile')}}"> {{Auth()->user()->name}}</a>
                                        </li>
                                        <br>
                                        <li>                                   
                                            <a href="{{route('customer.profile.order')}}">Lịch sử mua hàng</a>
                                        </li>
                                        <li>
                                            <a href="{{route('customer.auth.logout')}}">Đăng xuất</a>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a class="menu-bar mobile-navigation menu-toggle" href="#">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav-container rows-space-20">
        <div class="container">
            <div class="header-nav-wapper main-menu-wapper">
                <div class="vertical-wapper block-nav-categori">
                    <div class="block-title">
							<span class="icon-bar">
								<span></span>
								<span></span>
								<span></span>
							</span>
                        <span class="text">All Categories</span>
                    </div>
                    <div class="block-content verticalmenu-content">
                        <ul class="stelina-nav-vertical vertical-menu stelina-clone-mobile-menu">
                            <li class="menu-item">
                                <a href="#" class="stelina-menu-item-title" title="New Arrivals">New Arrivals</a>
                            </li>
                            <li class="menu-item">
                                <a title="Hot Sale" href="#" class="stelina-menu-item-title">Hot Sale</a>
                            </li>
                            <li class="menu-item menu-item-has-children">
                                <a title="Accessories" href="#" class="stelina-menu-item-title">Accessories</a>
                                <span class="toggle-submenu"></span>
                                <ul role="menu" class=" submenu">
                                    <li class="menu-item">
                                        <a title="Living" href="#" class="stelina-item-title">Living</a>
                                    </li>
                                    <li class="menu-item">
                                        <a title="Accents" href="#" class="stelina-item-title">Accents</a>
                                    </li>
                                    <li class="menu-item">
                                        <a title="New Arrivals" href="#" class="stelina-item-title">New Arrivals</a>
                                    </li>
                                    <li class="menu-item">
                                        <a title="Accessories" href="#" class="stelina-item-title">Accessories</a>
                                    </li>
                                    <li class="menu-item">
                                        <a title="Bedroom" href="#" class="stelina-item-title">Bedroom</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-nav">
                    <div class="container-wapper">
                        <ul class="stelina-clone-mobile-menu stelina-nav main-menu " id="menu-main-menu">
                            <li class="menu-item">
                                <a href="/" class="stelina-menu-item-title" title="Home">Home</a>
                                <span class="toggle-submenu"></span>
                            </li>
                            <li class="menu-item  menu-item-has-children item-megamenu">
                                <a href="#" class="stelina-menu-item-title" title="Pages">Shop</a>
                                <span class="toggle-submenu"></span>
                                <div class="submenu mega-menu menu-page">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 menu-page-item">
                                            <div class="stelina-custommenu default">
                                                <h2 class="widgettitle">Thương Hiệu</h2>
                                                <ul class="menu">
                                                    <li class="menu-item">
                                                        <a href="#">Dior</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">Versical</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">Armaf</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">Lacoste</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="">Gucci</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 menu-page-item">
                                            <div class="stelina-custommenu default">
                                                <h2 class="widgettitle">Xuất xứ</h2>
                                                <ul class="menu">
                                                    <li class="menu-item">
                                                        <a href="productdetails-fullwidth.html">Anh </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="productdetails-leftsidebar.html">Pháp</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="productdetails-rightsidebar.html">Ý</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 menu-page-item">
                                            <div class="stelina-custommenu default">
                                                <h2 class="widgettitle">Nồng độ</h2>
                                                <ul class="menu">
                                                    <li class="menu-item">
                                                        <a href="#">Eau De Parfum (EDP) </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">Eau De Cologne (EDC)</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">Parfum</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 menu-page-item">
                                            <div class="stelina-custommenu default">
                                                <h2 class="widgettitle">Nhóm hương</h2>
                                                <ul class="menu">
                                                    <li class="menu-item">
                                                        <a href="#">Floral Fruity - hương hoa cỏ trái cây</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">Nước hoa Floral Woody Musk - hương hoa cỏ, gỗ xạ hương</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">Nước hoa Oriental Floral: hoa cỏ phương Đông</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 menu-page-item">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 menu-page-item">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="menu-item  menu-item-has-children">
                                <a href="javascript:void(0)" class="stelina-menu-item-title"
                                   title="Blogs">Blogs</a>
                                <span class="toggle-submenu"></span>
                                <ul class="submenu">
                                    <li class="menu-item menu-item-has-children">
                                        <a href="#" class="stelina-menu-item-title" title="Blog Style">Kiến thức</a>
                                        <span class="toggle-submenu"></span>
                                        <ul class="submenu">
                                            <li class="menu-item">
                                                <a href="bloggrid.html">Chọn nước hoa cho người mới</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="bloglist.html">Phân biệt nước hoa</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#" class="stelina-menu-item-title" title="Post Layout">Kinh nghiệm</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children">
                                        <a href="#" class="stelina-menu-item-title" title="Post Layout">Góc review</a>
                                        <span class="toggle-submenu"></span>
                                        <ul class="submenu">
                                            <li class="menu-item">
                                                <a href="inblog_left-siderbar.html">Left Sidebar</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="inblog_right-siderbar.html">Right Sidebar</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="about.html" class="stelina-menu-item-title" title="About">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="header-device-mobile">
    <div class="wapper">
        <div class="item mobile-logo">
            <div class="logo">
                <a href="#">
                    <img src="https://placehold.co/169x45" alt="img">
                </a>
            </div>
        </div>
        <div class="item item mobile-search-box has-sub">
            <a href="#">
						<span class="icon">
							<i class="fa fa-search" aria-hidden="true"></i>
						</span>
            </a>
            <div class="block-sub">
                <a href="#" class="close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <div class="header-searchform-box">
                    <form class="header-searchform">
                        <div class="searchform-wrap">
                            <input type="text" class="search-input" placeholder="Enter keywords to search...">
                            <input type="submit" class="submit button" value="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="item mobile-settings-box has-sub">
            <a href="#">
						<span class="icon">
							<i class="fa fa-cog" aria-hidden="true"></i>
						</span>
            </a>
            <div class="block-sub">
                <a href="#" class="close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <div class="block-sub-item">
                    <h5 class="block-item-title">Currency</h5>
                    <form class="currency-form stelina-language">
                        <ul class="stelina-language-wrap">
                            <li class="active">
                                <a href="#">
											<span>
												English (USD)
											</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
											<span>
												French (EUR)
											</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
											<span>
												Japanese (JPY)
											</span>
                                </a>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="item menu-bar">
            <a class=" mobile-navigation  menu-toggle" href="#">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
</div>

@yield('page_content')

<footer class="footer style7">
    <div class="container">
        <div class="container-wapper">
            <div class="row">
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-sm hidden-md hidden-lg">
                    <div class="stelina-newsletter style1">
                        <div class="newsletter-head">
                            <h3 class="title">Newsletter</h3>
                        </div>
                        <div class="newsletter-form-wrap">
                            <div class="list">
                                Sign up for our free video course and <br/> urban garden inspiration
                            </div>
                            <input type="email" class="input-text email email-newsletter"
                                   placeholder="Your email letter">
                            <button class="button btn-submit submit-newsletter">SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="stelina-custommenu default">
                        <h2 class="widgettitle">Quick Menu</h2>
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="#">New arrivals</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Life style</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Accents</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Tables</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Dining</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-xs">
                    <div class="stelina-newsletter style1">
                        <div class="newsletter-head">
                            <h3 class="title">Newsletter</h3>
                        </div>
                        <div class="newsletter-form-wrap">
                            <div class="list">
                                Sign up for our free video course and <br/> urban garden inspiration
                            </div>
                            <input type="email" class="input-text email email-newsletter"
                                   placeholder="Your email letter">
                            <button class="button btn-submit submit-newsletter">SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="stelina-custommenu default">
                        <h2 class="widgettitle">Information</h2>
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="#">FAQs</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Track Order</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Delivery</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Contact Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">Return</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-end">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="stelina-socials">
                            <ul class="socials">
                                <li>
                                    <a href="#" class="social-item" target="_blank">
                                        <i class="icon fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-item" target="_blank">
                                        <i class="icon fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="social-item" target="_blank">
                                        <i class="icon fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="coppyright">
                            BkPerfume
                            <a href="#">v2024</a>
                            . All rights reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-device-mobile">
    <div class="wapper">
        <div class="footer-device-mobile-item device-home">
            <a href="/">
					<span class="icon">
						<i class="fa fa-home" aria-hidden="true"></i>
					</span>
                Home
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-wishlist">
            <a href="#">
					<span class="icon">
						<i class="fa fa-heart" aria-hidden="true"></i>
					</span>
                Wishlist
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <a href="#">
					<span class="icon">
						<i class="fa fa-shopping-basket" aria-hidden="true"></i>
						<span class="count-icon" id="cart-count-2">
							0
						</span>
					</span>
                <span class="text">Cart</span>
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-user">
            <a href="login.html">
					<span class="icon">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
                Account
            </a>
        </div>
    </div>
</div>

<a href="#" class="backtotop">
    <i class="fa fa-angle-double-up"></i>
</a>
<script src="{{asset('customer/assets/js/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('customer/assets/js/jquery.plugin-countdown.min.js')}}"></script>
<script src="{{asset('customer/assets/js/jquery-countdown.min.js')}}"></script>
<script src="{{asset('customer/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('customer/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('customer/assets/js/magnific-popup.min.js')}}"></script>
<script src="{{asset('customer/assets/js/isotope.min.js')}}"></script>
<script src="{{asset('customer/assets/js/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('customer/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('customer/assets/js/mobile-menu.js')}}"></script>
<script src="{{asset('customer/assets/js/chosen.min.js')}}"></script>
<script src="{{asset('customer/assets/js/slick.js')}}"></script>

<script src="{{asset('customer/assets/js/jquery.elevateZoom.min.js')}}"></script>
<script src="{{asset('customer/assets/js/jquery.actual.min.js')}}"></script>
<script src="{{asset('customer/assets/js/fancybox/source/jquery.fancybox.js')}}"></script>
<script src="{{asset('customer/assets/js/lightbox.min.js')}}"></script>
<script src="{{asset('customer/assets/js/owl.thumbs.min.js')}}"></script>
<script src="{{asset('customer/assets/js/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('customer/assets/js/frontend-plugin.js')}}"></script>


@yield('page_js')

</body>


</html>