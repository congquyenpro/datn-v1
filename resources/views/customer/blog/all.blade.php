@extends('customer.layout')

@section('page_content')
<div class="main-content main-content-blog grid no-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="/">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            @if ($slug == 'kien-thuc-ve-nuoc-hoa')
                                Kiến thức về nước hoa
                            @elseif ($slug == 'kinh-nghiem-chon-nuoc-hoa')
                                Kinh nghiệm chọn nước hoa
                            @elseif ($slug == 'goc-review')
                                Góc review
                            @elseif ($slug == 'chinh-sach-ban-hang')
                                Chính sách bán hàng
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-blog col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title capi">
                        @if ($slug == 'kien-thuc-ve-nuoc-hoa')
                            Kiến thức về nước hoa
                        @elseif ($slug == 'kinh-nghiem-chon-nuoc-hoa')
                            Kinh nghiệm chọn nước hoa
                        @elseif ($slug == 'goc-review')
                            Góc review
                        @elseif ($slug == 'chinh-sach-ban-hang')
                            Chính sách bán hàng
                        @endif
                    </h3>
                    <div class="blog-list grid-style">
                        <div class="row">
                            @foreach ($posts as $post)
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="blog-item">
                                    <div class="post-format">
                                        <a href="#">
                                            <img src="/{{$post->image}}" alt="img">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <div class="category-blog">
                                            <a href="#">{{$post->category}}</a>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="/post/{{$post->slug}}">{{$post->title}}</a>
                                        </h3>
                                        <div class="main-info-post">
                                            <p class="des">
                                                {{$post->summary}}
                                            </p>
                                        </div>
                                        <div class="author-view">
                                            <div class="author">
                                                <div class="avt">
                                                    <img src="/admin_assets/images/logo_banner/BKP.png" alt="img">
                                                </div>
                                                <h3 class="name">
                                                   {{--  Admin --}}
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
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
{{--                     <div class="pagination clearfix style2 grid">
                        <div class="nav-link">
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>
                            <a href="#" class="page-numbers current">1</a>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers">3</a>
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection