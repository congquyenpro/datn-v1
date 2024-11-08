
@extends('customer.layout')

@section('page_title', $post->title)


@section('meta_tags')
<meta name="description" content="{{$post->summary}}">
    @php
        $tag_list = ''; // Khởi tạo biến tag_list trước khi vòng lặp bắt đầu
    @endphp

    @foreach ($tags as $tag)
        @php
            // Nối mỗi tag vào $tag_list, thêm dấu phẩy sau mỗi tag
            $tag_list .= $tag . ', ';
        @endphp
    @endforeach

    @php
        $tag_list = rtrim($tag_list, ', ');
    @endphp
<meta name="keywords" content="{{$tag_list}}">
@endsection

@section('page_content')
<div class="main-content main-content-blog single right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index-2.html">Home</a>
                        </li>
                        <li class="trail-item">
                            <a href="#">Blog</a>
                        </li>
                        <li class="trail-item">
                            <a href="#">{{$post->category}}</a>
                        </li>
                        <li class="trail-item trail-end active">
                            {{$post->title}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-blog col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="site-main">
                    <div class="post-item">
                        <div class="post-format">
{{--                             <a href="#">
                                <img src="assets/images/blog1.jpg" alt="img">
                            </a> --}}
                        </div>
                        <div class="post-infor">
                            <div class="category-blog">
                                <a href="#">{{$post->category}}</a>
                            </div>
                            <h3 class="post-title">
                                <h1 style=" text-align: center; justify-content: center; display: flex; " >{{$post->title}}</h1>
                            </h3>
                            <div class="main-info-post">
                                <p>
                                    {!! $post->content !!}
                                </p>

<!-- 									<blockquote>
                                    <p>
                                        Maecenas vel nulla eleifend, euismod magna sed, tristique velit.
                                        Nam sed eleifend dui, eu eleifend leo. 
                                        Mauris ornare eros quis placerat mollis.
                                        Duis ornare euismod risus at dictum. 
                                        Proin at porttitor metus. 
                                        Nunc luctus nisl suscipit, hendrerit ligula non, mattis dolor.
                                    </p>
                                    <div class="author">
                                        <span class="name">
                                            Koan Conella
                                        </span>
                                        <span class="desc">
                                            Creative Copywriter
                                        </span>
                                    </div>
                                </blockquote> -->
                            </div>
                        </div>
                    </div>

                    <div class="tags tags-blog">
                        <h3 class="widgettitle">
                            Tags:
                        </h3>
                        <ul class="tagcloud">
                            @foreach ($tags as $tag)
                                <li class="tag-cloud-link">
                                    <a href="#">{{$tag}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="view-share">
                        <div class="author-view">
                            <div class="author">
                                <div class="avt">
                                    <img src="assets/images/avt-blog1.png" alt="img">
                                </div>
                                <h3 class="name">
                                    BkPerfume
                                </h3>
                            </div>
                            <div class="review">
                                <div class="view">
                                    <span class="icon-view">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                    <span class="count">
                                        631
                                    </span>
                                </div>
                                <div class="s-comments">
                                    <span class="icon-cmt">
                                        <i class="fa fa-commenting" aria-hidden="true"></i>
                                    </span>
                                    <span class="count">
                                        82
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="share">
                            <h3 class="title">share</h3>
                            <i class="icon fa fa-facebook-square" aria-hidden="true"></i>
                            <i class="icon fa fa-linkedin" aria-hidden="true"></i>
                            <i class="icon fa fa-twitter" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h3 class="custom_blog_title">
                            Comments <span class="count">(2)</span>
                        </h3>
                        <form class="comment-form">
                            <p class="comment-reply-content">
                                <textarea  rows="6" placeholder="Write your comment" class="input-form"></textarea>
                            </p>
                            <p class="form-submit">
                                <span class="controll">
                                    <i class="icon fa fa-file-image-o" aria-hidden="true"></i>
                                    <i class="icon fa fa-paperclip" aria-hidden="true"></i>
                                    <i class="icon fa fa-smile-o" aria-hidden="true"></i>
                                    <button class="submit button">POST A COMMENT</button>		
                                </span>	
                            </p>
                        </form>
                        <ul class="comment-list">
                            <li class="comment">
                                <div class="comment-item">
                                    <div class="author-view">
                                        <div class="author">
                                            <div class="avt">
                                                <img src="assets/images/avt-blog1.png" alt="img">
                                            </div>
                                            <h3 class="name">
                                                Adam Smith
                                            </h3>
                                        </div>
                                        <div class="date-reply-comment">
                                            <span class="date-comment">
                                                4 days ago
                                            </span>
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <div class="comment-content">
                                            <p>
                                                Nam sed eleifend dui, eu eleifend leo.
                                                Mauris ornare eros quis placerat mollis. 
                                                Duis ornare euismod risus at dictum. 
                                                Proinat porttitor metus. 
                                                Nunc luctus nisl suscipit, hendrerit ligula non.
                                            </p>
                                        </div>
                                        <div class="comment-reply-link">
                                            <span class="Comment">
                                                <i class="icon fa fa-commenting" aria-hidden="true"></i>
                                                Comment
                                            </span>
                                            <span class="like">
                                                <i class="icon fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                1
                                            </span>
                                            <span class="dislike">
                                                <i class="icon fa fa-thumbs-o-down" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="children">
                                    <li>
                                        <div class="comment-item">
                                            <div class="author-view">
                                                <div class="author">
                                                    <div class="avt">
                                                        <img src="assets/images/avt-blog1.png" alt="img">
                                                    </div>
                                                    <h3 class="name">
                                                        Samuel Godi
                                                    </h3>
                                                </div>
                                                <div class="date-reply-comment">
                                                    <span class="date-comment">
                                                        4 days ago
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="comment-body">
                                                <div class="comment-content">
                                                    <p>
                                                        Ut pellentesque gravida justo non rhoncus. 
                                                        Nunc ullamcorper tortor id aliquet luctus. 
                                                        Proin varius aliquam consequat.Curabitur a commodo diam, vitae pellentesque urna.
                                                    </p>
                                                </div>
                                                <div class="comment-reply-link">
                                                    <span class="Comment">
                                                        <i class="fa fa-commenting" aria-hidden="true"></i>
                                                        Comment
                                                    </span>
                                                    <span class="like">
                                                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                        9
                                                    </span>
                                                    <span class="dislike">
                                                        <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                                        1
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="pagination clearfix style1">
                        <div class="nav-link">
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>
                            <a href="#" class="page-numbers">1</a>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers current">3</a>
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar sidebar-single-blog col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="wrapper-sidebar">
<!-- 						<div class="widget widget-socials">
                        <h3 class="widgettitle">
                            Follow us
                        </h3>
                        <div class="content-socials">
                            <div class="social-list">
                                <a href="#" target="_blank" class="social-item">
                                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                </a>
                                <a href="#" target="_blank" class="social-item">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="#" target="_blank" class="social-item">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div> -->
                    <div class="widget widget-categories">
                        <h3 class="widgettitle">Danh mục</h3>
                        <ul class="list-categories">
                            <li>
                                <input type="checkbox" id="cb1">
                                <label for="cb1" class="label-text">
                                    Kiến thức
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="cb2">
                                <label for="cb2" class="label-text">
                                    Chia sẻ
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="cb3">
                                <label for="cb3" class="label-text">
                                    Review
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="widget widget-post">
                        <h3 class="widgettitle">Popular Articles</h3>
                        <ul class="stelina-posts">
                            <li class="widget-post-item">
                                <div class="thumb-blog">
                                    <img src="assets/images/sidebar-post1.jpg" alt="img">
                                </div>
                                <div class="post-content">
                                    <div class="cat">
                                        <a href="#">Life Style</a>
                                    </div>
                                    <h5 class="post-title"><a href="#">9 Quicks Tips That Will Change <span>[...]</span></a></h5>
                                </div>
                            </li>
                            <li class="widget-post-item">
                                <div class="thumb-blog">
                                    <img src="assets/images/sidebar-post2.jpg" alt="img">
                                </div>
                                <div class="post-content">
                                    <div class="cat">
                                        <a href="#">Lookbook</a>
                                    </div>
                                    <h5 class="post-title"><a href="#">9 Quicks Tips That Will Change <span>[...]</span></a></h5>
                                </div>
                            </li>
                            <li class="widget-post-item">
                                <div class="thumb-blog">
                                    <img src="assets/images/sidebar-post3.jpg" alt="img">
                                </div>
                                <div class="post-content">
                                    <div class="cat">
                                        <a href="#">Street Style</a>
                                    </div>
                                    <h5 class="post-title"><a href="#">9 Quicks Tips That Will Change <span>[...]</span></a></h5>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div class="widget widget-tags">
                        <h3 class="widgettitle">
                            Popular Tags
                        </h3>
                        <ul class="tagcloud">
                            <li class="tag-cloud-link">
                                <a href="#">Office</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Accents</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Flowering</a>
                            </li>
                            <li class="tag-cloud-link active">
                                <a href="#">Accessories</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Hot</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Tables</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Dining</a>
                            </li>
                        </ul>
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
@endsection

@section('page_js')
    <script src="{{asset('customer/page/js/api.js')}}"></script>
    <script src="{{asset('customer/page/js/cart.js')}}"></script>
    <script src="{{asset('customer/page/js/index.js')}}"></script>
@endsection
