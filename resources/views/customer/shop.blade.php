@extends('customer.layout')

@section('page_css')
<style>
    /* Thêm thuộc tính để trên điện thoại ẩn bớt tìm kiếm ở dưới đi, còn lại phải ấn lọc chi tiết */
    @media (max-width: 768px) {
        .widget.widget-categories {
            display: none;
        }
    }
</style>
<link rel="stylesheet" href="{{asset('customer/page/css/shop.css')}}">:
@endsection

@section('page_content')
<div class="main-content main-content-product left-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index-2.html">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            Grid Products
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area shop-grid-content no-banner col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">
                        Grid Products
                    </h3>
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tìm kiếm nâng cao</button>

                    <div class="shop-top-control">
                        <form class="select-item select-form">
                            <span class="title">Sort</span>
                            <select title="sort" id="sort" data-placeholder="12 Products/Page" class="chosen-select">
                                <option value="1">9 Products/Page</option>
                                <option value="2">15 Products/Page</option>
                            </select>
                        </form>
                        <form class="filter-choice select-form">
                            <span class="title">Sort by</span>
                            <select id="sort-by" title="sort-by" data-placeholder="Price: Low to High" class="chosen-select">
                                <option value="1">Price: Low to High</option>
                                <option value="2">Price: High to Low</option>
                                <option value="3">Sort by popularity</option>
                                <option value="4">Sort by newness</option>
                            </select>
                        </form>
                        <div class="grid-view-mode">
                            <div class="inner">
                                <a href="listproducts.html" class="modes-mode mode-list">
                                    <span></span>
                                    <span></span>
                                </a>
                                <a href="gridproducts.html" class="modes-mode mode-grid  active">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="row list-products auto-clear equal-container product-grid">
                        <div id="product-list">

                        </div>
                    </ul>
                    <div class="pagination clearfix style3">
                        <div class="nav-link">
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-left"
                                                                aria-hidden="true"></i></a>
                            <a href="#" class="page-numbers">1</a>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers current">3</a>
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-right"
                                                                aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="wrapper-sidebar shop-sidebar">
                    <div class="widget woof_Widget">
                        <div class="widget widget-tags">
                            <h3 class="widgettitle">
                                Popular Tags
                            </h3>
                            <ul class="tagcloud">
                                <li class="tag-cloud-link">
                                    <a href="#">All</a>
                                </li>
                                <li class="tag-cloud-link active">
                                    <a href="#">For You</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">Best Selling</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">Top Viewed</a>
                                </li>
                                <li class="tag-cloud-link">
                                    <a href="#">New</a>
                                </li>
                            </ul>
                        </div>
                        <div style="margin-bottom: 10px; cursor:pointer;" id="delete-all-filter">
                            <div style="border: 1px dotted;padding: 4px;text-align: center;font-weight: bold;font-size: 14px;color: #ab8e66;">Xóa bộ lọc</div>
                        </div>
                        <div class="widget widget-categories" id="filter-by-brand">
                            <h3 class="widgettitle">Thương hiệu</h3>
                            
                            <!-- Search bar -->
                            <input type="text" id="brand-search" placeholder="Tìm thương hiệu..." class="search-bar">
                        
                            <!-- Scrollable category list -->
                            <ul class="list-categories" id="filter-brand">
                                <!-- More items can be added here -->
                            </ul>
                        </div>
                        <div class="widget widget-categories one-choice" id="filter-by-gender">
                            <h3 class="widgettitle">Giới tính</h3>
                            <ul class="list-brand" id="filter-gender">
                            </ul>
                        </div>
                        <div class="widget widget_filter_price" id="filter-by-price">
                            <h4 class="widgettitle">
                                Khoảng giá
                            </h4>
                            <div class="price-slider-wrapper">
                                <div data-label-reasult="Range:" data-min="0" data-max="20000000" data-unit="₫"
                                     class="slider-range-price " data-value-min="500000" data-value-max="2000000">
                                </div>
                                <div class="price-slider-amount">
                                    <span class="from">₫500000</span>
                                    <span class="to">₫2000000 </span>
                                </div>
                            </div>
                        </div>
                        <!-- Advanced Filter -->
                        <div style="margin-bottom: 10px; cursor:pointer;" id="view-advanced-filter">
                            <div style="border: 1px dotted;padding: 4px;text-align: center;font-weight: bold;font-size: 14px;color: #ab8e66;">Lọc nâng cao</div>
                        </div>
                        
                        <div id="advanced-filter">
                            <div class="widget widget-categories" id="filter-by-country">
                                <h3 class="widgettitle">Xuất xứ</h3>
                                
                                <!-- Search bar -->
                                <input type="text" id="country-search" placeholder="Tìm xuất xứ..." class="search-bar">
                            
                                <!-- Scrollable category list -->
                                <ul class="list-categories" id="filter-country">
                                </ul>
                            </div>
                            <div class="widget widget-categories" id="filter-by-age">
                                <h3 class="widgettitle">Độ tuổi</h3>
    
                                <input type="text" id="age-group-search" placeholder="Tìm độ tuổi..." class="search-bar">
                                <!-- Scrollable category list -->
                                <ul class="list-categories" id="filter-age_group">
                                    <!-- More items can be added here -->
                                </ul>
                            </div>
                            <div class="widget widget-categories" id="filter-by-concentration">
                                <h3 class="widgettitle">Nồng độ</h3>
                                <!-- Search bar -->
                                <input type="text" id="concentration-search" placeholder="Tìm nồng độ..." class="search-bar">                            
                                <ul class="list-categories" id="filter-concentration">
           
                                </ul>
                            </div>
                            <div class="widget widget-categories" id="filter-by-style">
                                <h3 class="widgettitle">Phong cách</h3>
                                <!-- Search bar -->
                                <input type="text" id="style-search" placeholder="Tìm phong cách..." class="search-bar">                            
                                <ul class="list-categories" id="filter-style">
                         
                                </ul>
                            </div>
                            <div class="widget widget-categories" id="filter-by-frag-group">
                                <h3 class="widgettitle">Nhóm hương</h3>
                                <!-- Search bar -->
                                <input type="text" id="frag-group-search" placeholder="Tìm nhóm hương..." class="search-bar">
                                <ul class="list-categories" id="filter-frag_group">
    
                                </ul>
                            </div>
                            <div class="widget widget-categories" id="filter-by-frag-time">
                                <h3 class="widgettitle">Độ lưu hương</h3>
                                <!-- Search bar -->
                                <input type="text" id="frag-time-search" placeholder="Tìm độ lưu hương..." class="search-bar">
                                <ul class="list-categories" id="filter-frag_time">
                                
                                </ul>
                            </div>
                            <div class="widget widget-categories" id="filter-by-frag-distance">
                                <h3 class="widgettitle">Độ tỏa hương</h3>
                                <input type="text" id="frag-distance-search" placeholder="Tìm độ tỏa hương..." class="search-bar">
                                <ul class="list-categories" id="filter-frag_distance">
                                  
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="widget newsletter-widget">
                        <div class="newsletter-form-wrap ">
                            <h3 class="title">Subscribe to Our Newsletter</h3>
                            <div class="subtitle">
                                More special Deals, Events & Promotions
                            </div>
                            <input type="email" class="email" placeholder="Your email letter">
                            <button type="submit" class="button submit-newsletter">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal advance filter -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" >
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="sidebar col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrapper-sidebar shop-sidebar">
                    <div class="widget woof_Widget">
                        <div class="widget widget-categories">
                        </div>
                        <div class="row">
                            <div class="col-sm-12 .col-md-12 .col-lg-12 .col-xl-12" style="margin-bottom: 25px;">
                                <h3 class="widgettitle">Categories</h3>
                            
                                <!-- Search bar -->
                                <input type="text" id="category-search" placeholder="Search categories..." class="search-bar">
                            
                                <!-- Scrollable category list -->
                                <ul class="list-categories">
                                    <li>
                                        <input type="checkbox" id="aa1">
                                        <label for="aa1" class="label-text">New Arrivals</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb2">
                                        <label for="cb2" class="label-text">Dining</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb3">
                                        <label for="cb3" class="label-text">Desks</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb4">
                                        <label for="cb4" class="label-text">Accents</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb5">
                                        <label for="cb5" class="label-text">Accessories</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb6">
                                        <label for="cb6" class="label-text">Tables</label>
                                    </li>
                                    <!-- More items can be added here -->
                                </ul>
                            </div>
                            <div class="col-sm-12 .col-md-12 .col-lg-12 .col-xl-12" style="margin-bottom: 25px;">
                                <h3 class="widgettitle">Categories</h3>
                                <ul class="list-categories">
                                    <li>
                                        <input type="checkbox" id="cb1">
                                        <label for="cb1" class="label-text">
                                            New Arrivals
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb2">
                                        <label for="cb2" class="label-text">
                                            Dining
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb3">
                                        <label for="cb3" class="label-text">
                                            Desks
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb4">
                                        <label for="cb4" class="label-text">
                                            Accents
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb5">
                                        <label for="cb5" class="label-text">
                                            Accessories
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cb6">
                                        <label for="cb6" class="label-text">
                                            Tables
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget widget_filter_price">
                            <h4 class="widgettitle">
                                Price
                            </h4>
                            <div class="price-slider-wrapper">
                                <div data-label-reasult="Range:" data-min="0" data-max="3000" data-unit="$"
                                     class="slider-range-price " data-value-min="0" data-value-max="1000">
                                </div>
                                <div class="price-slider-amount">
                                    <span class="from">$45</span>
                                    <span class="to">$215</span>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-tags">
                            <h3 class="widgettitle">
                                Popular Tags
                            </h3>
                            <ul class="tagcloud">
                                <li class="tag-cloud-link">
                                    <a href="#">Hot</a>
                                </li>
                                <li class="tag-cloud-link active">
                                    <a href="#">For you</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>

  <script>
    /* Mở modal khi code */
window.onload = function() {
    var modal = document.getElementById('myModal');
    modal.classList.add('in'); // Thêm lớp 'in' để có hiệu ứng hiển thị
};

</script>
@endsection

@section('page_js')

<script src="{{asset('customer/page/js/shop.js')}}"></script>
<script src="{{asset('customer/page/js/api.js')}}"></script>
<script src="{{asset('customer/page/js/page_product.js')}}"></script>

<script>
    const markPriceRange = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const minPrice = urlParams.get('price_min');
        const maxPrice = urlParams.get('price_max');

        if (minPrice && maxPrice) {
            // Cập nhật slider giá
            $('.slider-range-price').slider('values', [parseInt(minPrice), parseInt(maxPrice)]);
            // Cập nhật giá hiển thị
            $('.price-slider-amount .from').text('₫' + minPrice);
            $('.price-slider-amount .to').text('₫' + maxPrice);
        }
    };

    $(document).ready(function() {
        const $slider = $('.slider-range-price');

        // Khởi tạo slider
        $slider.slider({
            range: true,
            min: 0,
            max: 20000000,
            values: [0, 20000000],
            slide: function(event, ui) {
                // Cập nhật giá hiển thị
                $('.price-slider-amount .from').text('₫' + ui.values[0]);
                $('.price-slider-amount .to').text('₫' + ui.values[1]);
                // Cập nhật tham số khoảng giá vào URL
                updatePriceRangeLink(ui.values[0], ui.values[1]);
            }
        });

        // Hàm cập nhật link
        function updatePriceRangeLink(minPrice, maxPrice) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('price_min', minPrice);
            urlParams.set('price_max', maxPrice);

            const link = `/shop?${urlParams.toString()}`;
            history.pushState(null, '', link);
        }

        // Khởi động giá hiển thị ban đầu
        $('.price-slider-amount .from').text('₫' + $slider.slider("values", 0));
        $('.price-slider-amount .to').text('₫' + $slider.slider("values", 1));

        // Gọi hàm để thiết lập giá trị slider từ URL
        markPriceRange();
    });
</script>
@endsection
