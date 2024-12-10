
@extends('customer.layout')

@section('page_title', $post->title)


@section('meta_tags')
<meta name="description" content="{{$post->summary}}">
<meta name="keywords" content="{{$tags}}">
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
                            @php
                                // Chuyển chuỗi tags thành mảng bằng dấu phẩy
                                $tagsArray = explode(',', $tags);
                            @endphp
                        
                            @foreach ($tagsArray as $tag)
                                <li class="tag-cloud-link">
                                    <a href="#">{{ trim($tag) }}</a> <!-- Dùng trim để loại bỏ khoảng trắng nếu có -->
                                </li>
                            @endforeach
                        </ul>
                        
                    </div>
                    <div class="view-share">
                        <div class="author-view">
                            <div class="author">
                                <div class="avt">
                                    <img src="/admin_assets/images/logo_banner/BKP.png" alt="img">
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
                        @if (!Auth::check())
                            <div style="margin-bottom: 10px; cursor:pointer;" id="view-more-comments">
                                <div style="border: 1px dotted;padding: 4px;text-align: center;font-weight: bold;font-size: 14px;color: #ab8e66;"><a href="{{route('customer.auth.login')}}">Đăng nhập để bình luận</a></div>
                            </div>
                        @else
                            <form class="comment-form">
                                <p class="comment-reply-content">
                                    <textarea  rows="3" placeholder="Write your comment" class="input-form" id="comment-form"></textarea>
                                </p>
                                <p class="form-submit">
                                    <span class="controll">
    <!-- 										<i class="icon fa fa-file-image-o" aria-hidden="true"></i>
                                        <i class="icon fa fa-paperclip" aria-hidden="true"></i> -->
                                        <i class="icon fa fa-smile-o" aria-hidden="true"></i>
                                        <a href="javascript:void()" class="submit button" id="submit-comment">POST A COMMENT</a>		
                                    </span>	
                                </p>
                            </form>
                        @endif

                        <ul class="comment-list" id="list-comments">

<!-- 								<li class="comment">
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
                            </li> -->
                        </ul>
                    </div>
                    <div class="pagination clearfix style1">
                        <div class="nav-link">
                            <a href="#" class="page-numbers"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>
                            <a href="#" class="page-numbers current">1</a>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers">3</a>
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
                                <input type="checkbox" id="cb1" 
                                       @if ($post->category == 'Kiến thức về nước hoa') checked @endif>
                                <label for="cb1" class="label-text">
                                    Kiến thức về nước hoa
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="cb2" disabled 
                                       @if ($post->category == 'Kinh nghiệm chọn nước hoa') checked @endif>
                                <label for="cb2" class="label-text">
                                    Kinh nghiệm chọn nước hoa
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="cb3" disabled 
                                       @if ($post->category == 'Góc Review') checked @endif>
                                <label for="cb3" class="label-text">
                                    Góc Review
                                </label>
                            </li>
                        </ul>                        
                    </div>
                    <div class="widget widget-post">
                        <h3 class="widgettitle">Popular Articles</h3>
                        <ul class="stelina-posts">
                            @foreach ($latestPosts as $ltp)
                                <li class="widget-post-item">
                                    <div class="thumb-blog">
                                        <img src="/{{$ltp->image}}" alt="img">
                                    </div>
                                    <div class="post-content">
                                        <div class="cat">
                                            <a href="#">Chia sẻ</a>
                                        </div>
                                        <h5 class="post-title"><a href="/post/{{$ltp->slug}}">{{$ltp->title}} <span>[...]</span></a></h5>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget-tags">
                        <h3 class="widgettitle">
                            Popular Tags
                        </h3>
                        <ul class="tagcloud">
                            <li class="tag-cloud-link">
                                <a href="#">Nước hoa</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Nước hoa Nam</a>
                            </li>
                            <li class="tag-cloud-link active">
                                <a href="#">Nước hoa chính hãng</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Nước hoa nữ</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Trending</a>
                            </li>
                            <li class="tag-cloud-link">
                                <a href="#">Nước hoa Dior</a>
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
  {{--   <script src="{{asset('customer/page/js/index.js')}}"></script> --}}

    <script>
        function getComments() {
            const listComments = $('#list-comments');

            let pathname = window.location.pathname;

            // Tách các phần trong đường dẫn theo dấu '/'
            let pathParts = pathname.split('/');

            // Giả sử phần cần lấy luôn nằm ở cuối URL sau phần '/nuoc-hoa/'
            let postSlug = pathParts[pathParts.length - 1];
            let type= "post";
            let avatar_list = [
                "/customer/page/images/user_avatar.jpeg",
                
            ]

            Api.Comment.getComments(postSlug, type).done(function(data){
                listComments.html('');
                data.forEach(element => {
                    const formattedDate = new Date(element.created_at).toLocaleDateString('vi-VN', {
                        day: 'numeric', month: 'long', year: 'numeric'
                    });
                    listComments.append(`
                            <li class="comment">
                                <div class="comment-item">
                                    <div class="author-view">
                                        <div class="author">
                                            <div class="avt" style = "margin-right: 15px">
                                                <img src="${avatar_list[0]}" alt="img">
                                            </div>
                                            <h3 class="name">
                                               ${element.user.name}
                                            </h3>
                                        </div>
                                        <div class="date-reply-comment">
                                            <span class="date-comment">
                                                ${formattedDate}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="comment-body">
                                        <div class="comment-content">
                                            <p>
                                                ${element.content}
                                            </p>
                                        </div>
                                        <div class="comment-reply-link">
                                            <span class="Comment">
                                                <i class="icon fa fa-commenting" aria-hidden="true"></i>
                                                Reply
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
                            </li>
                    `);
                });
            });
        };
        getComments();
        function addComment() {
            $('#submit-comment').off('click');
            $('#submit-comment').on('click', function(e) {
                e.preventDefault();
                var content = $('#comment-form').val();

                //Check nếu null
                if (content == '') {
                    alert('Vui lòng nhập đủ thông tin');
                    return;
                }


                // Lấy URL hiện tại của trang
                const url = window.location.pathname;  // Lấy toàn bộ URL (chỉ lấy phần đường dẫn)

                // Tách chuỗi theo dấu "/"
                const parts = url.split('/');

                // Lấy phần cuối cùng trong mảng parts (phần bạn cần)
                const slug = parts[parts.length - 1];  // "versace-eros-edt"

                var data = {
                    commentable_type: 'post',
                    slug: slug,
                    content: content,
                };
                Api.Comment.createComment(data).done(function(res){
                    if (res.status == 201){
                        alert('Bình luận thành công !');
                        getComments();
                        //Xóa nội dung comment cũ
                        $('#comment-form').val('');
                    }
                });
            });

        };
        addComment();
    </script>
@endsection
