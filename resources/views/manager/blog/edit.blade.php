@extends('manager.layout')

@section('page_title', 'Blog')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('page_content')

<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Blog</h4>
                </div>
            </div>
        </div>
    </div>
    <div id="post-template">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <button class="btn btn-secondary btn-tone m-r-5 float-right" id="view-post-guild">Xem hướng dẫn</button>
                            <h5 class="card-title">Hướng dẫn tạo bài đăng hiệu quả</h5>
                            <div id="post-guild">
                                <p class="card-text m-l-10">Dưới đây là các trường cần có trong bài đăng để SEO hiệu quả:</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Tiêu đề:</strong> Cần chứa từ khóa chính mà người dùng có thể tìm kiếm, đồng thời hấp dẫn và dễ đọc. Không nên dài quá 60 ký tự, vì Google sẽ hiển thị tối đa 60 ký tự trong kết quả tìm kiếm.
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Mô tả ngắn:</strong> Mô tả ngắn gọn về bài viết, bao gồm từ khóa chính. Google thường hiển thị đoạn này dưới tiêu đề trong kết quả tìm kiếm. Độ dài tối ưu từ 150-160 ký tự.
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Từ khóa:</strong> Các từ khóa chính mà bạn muốn bài viết xếp hạng trên các công cụ tìm kiếm. Từ khóa này nên được chọn kỹ lưỡng dựa trên nghiên cứu từ khóa (keyword research). Không nhồi nhét từ khóa, chỉ sử dụng từ khóa một cách tự nhiên.
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Danh mục sản phẩm:</strong> Chọn danh mục liên quan đến sản phẩm (ví dụ: nước hoa nam, nước hoa nữ, nước hoa cao cấp, nước hoa dành cho mùa hè, v.v.).
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Mô tả chi tiết:</strong> Đây là phần quan trọng nhất, cần mô tả chi tiết về sản phẩm như: thành phần, mùi hương, cảm giác sau khi sử dụng, v.v.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>                                
                <div class="col-sm-12 col-md-12 col-lg-12 m-b-10">
                    <div id="staus-notice">

                    </div>
                    <!-- Nút chức năng -->
                    <button class="btn btn-danger btn-tone m-r-5 float-right" id="btn-delete">Xóa</button>
                    <button class="btn btn-primary btn-tone m-r-5 float-right" id="btn-save">Lưu</button>
                    <a href="{{route('manager.blog')}}" class="btn btn-default m-r-5 float-right" id="btn-cancel">Đóng</a>
                </div>
                
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Form nhập liệu -->
                                    <form id="post-form" action="/submit" method="POST">
                                        <div class="form-group">
                                            <label for="post-title">Tiêu đề</label>
                                            <input type="text" class="form-control" id="post-title" name="title" placeholder="Tiêu đề" value="{{$post->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="post-summary">Tóm tắt</label>
                                            <input type="text" class="form-control" id="post-summary" name="summary" placeholder="Tóm tắt" value="{{$post->summary}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="post-content">Nội dung</label>
                                            <textarea id="summernote" name="content">{{$post->content}}</textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-b-10">Bình luận</div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <div class="radio">
                                                    <input type="radio" name="comment_status" id="comment-enable" value="enabled" 
                                                    @if($post->comment_status == 'enabled') checked @endif>
                                                    <label for="comment-enable">
                                                        Bật
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="comment_status" id="comment-disable" value="disabled"
                                                    @if($post->comment_status == 'disabled') checked @endif>
                                                    <label for="comment-disable">
                                                        Tắt
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="comment_status" id="comment-auto" value="auto"
                                                    @if($post->comment_status == 'auto') checked @endif>
                                                    <label for="comment-auto">
                                                        Tạo tự động
                                                    </label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </fieldset>
                
                                    <div class="m-b-10">Danh sách bình luận (28)</div>
                                    <div class="comments-list">
                                        <div class="comment m-b-5">
                                            <div class="comment-by">
                                                <span class="comment-author"><strong>Công Nguyễn</strong></span>
                                                <span class="comment-date m-l-10 font-italic">5/11/2024</span>
                                            </div>
                                            <span>Tuyệt vời !</span>
                                            <div class="">
                                                <a href="javascript:void(0)" class="m-r-10 text-info">Trả lời</a>
                                                <a href="javascript:void(0)" class="text-danger">Xóa</a>
                                            </div>
                                        </div>
                                        <div class="comment m-b-5">
                                            <div class="comment-by">
                                                <span class="comment-author"><strong>Nguyễn Công</strong></span>
                                                <span class="comment-date m-l-10 font-italic">5/11/2024</span>
                                            </div>
                                            <span>Bài viết hữu ích</span>
                                            <div class="">
                                                <a href="javascript:void(0)" class="m-r-10 text-info">Trả lời</a>
                                                <a href="javascript:void(0)" class="text-danger">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-b-10">Trạng thái</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <select id="post-status" name="status" class="form-control">
                                                <option value="public" @if($post->status == 'public') selected @endif>Công khai</option>
                                                <option value="hidden" @if($post->status == 'hidden') selected @endif>Ẩn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-b-10">Hình ảnh</div>
                                    <div>
                                        <!-- Thẻ img sẽ hiển thị hình ảnh preview -->
                                        <img src="/{{$post->image}}" alt="post-image" id="post-image" width="100%">
                                    </div>
                                    <div class="custom-file m-t-20">
                                        <!-- Thẻ input cho phép người dùng chọn file -->
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-b-10">Từ khóa</div>
                                    <div>
                                        <select class="select2" name="tags[]" multiple="multiple" id="post-tags">
                                            <option value="nước hoa">nước hoa</option>
                                            <option value="nước hoa nam">nước hoa nam</option>
                                            <option value="nước hoa Nữ">nước hoa nữ</option>
                                            <option value="nước hoa chính hãng">nước hoa chính hãng</option>
                                            <option value="nước hoa dior">nước hoa dior</option>
                                        </select>
                                    </div>
                                    <a href="javascript:void(0)" id="add-tags" class="m-t-5 float-right">Thêm từ khóa</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Trending Search</label>
                                            <input type="text" class="form-control" id="trending-keyword" placeholder="Nhập từ khóa...">
                                        </div>
                                        <button id="trending-search" class="btn btn-primary btn-tone m-r-5 float-right">Nghiên cứu</button>
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
    <!-- page js -->
    <script src="{{asset('admin_assets/assets/vendors/select2/select2.min.js')}}"></script>

    <script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>

    <script>
            $('.select2').select2();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300
            });
        });
    </script>    

    <script>
        $('#post-guild').hide();
        $('#view-post-guild').on('click', function() {
            $('#post-guild').toggle();
            if ($('#post-guild').is(':visible')) {
                this.innerHTML = 'Ẩn hướng dẫn';
            } else {
                this.innerHTML = 'Xem hướng dẫn';
            }
        });        
    </script>

<script>
    update = function(id) {
        console.log("Updating post with id: " + id);

        // Lấy dữ liệu bài viết từ server (AJAX GET)
        $.ajax({
            url: '/api/blog/' + id,  // Đảm bảo URL này là chính xác và trả về dữ liệu bài viết
            method: 'GET',
            success: function(res) {
                if (res.status == 200) {
                    var post = res.data; // Dữ liệu bài viết trả về từ server

                    // Điền dữ liệu vào form update
                    $('#post-title').val(post.title);
                    $('#post-summary').val(post.summary);
                    $('textarea[name="content"]').val(post.content);
                    $('#post-status').val(post.status);
                    $('input[name="comment_status"][value="' + post.comment_status + '"]').prop('checked', true);
                    
                    // Xử lý tags (tags có thể là chuỗi JSON từ server)
                    var tags = JSON.parse(post.tags || '[]');
                    $('#post-tags').val(tags).trigger('change');  // select2 sử dụng trigger('change') để cập nhật giá trị

                    // Hiển thị hình ảnh hiện tại (nếu có)
                    $('#post-image').attr('src', '/' + post.image); // Cập nhật hình ảnh

                    // Hiển thị form đăng bài và ẩn phần còn lại
                    $('#post-template').show();
                    $('#main-template').hide();

                    // Cập nhật ảnh khi người dùng chọn ảnh mới
                    $('#customFile').on('change', function(event) {
                        var file = event.target.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#post-image').attr('src', e.target.result);  // Cập nhật ảnh preview
                        };
                        reader.readAsDataURL(file);
                    });

                    // Submit dữ liệu khi nhấn nút "Cập nhật"
                    $('#btn-save').on('click', function() {
                        // Lấy dữ liệu từ các trường trong form
                        var title = $('#post-title').val();
                        var summary = $('#post-summary').val();
                        var content = $('textarea[name="content"]').val();
                        var status = $('#post-status').val();
                        var tags = $('#post-tags').val();
                        var commentStatus = $('input[name="comment_status"]:checked').val();
                        var imageFile = $('#customFile')[0].files[0];

                        if (imageFile && imageFile.size > 5 * 1024 * 1024) {
                            alert("Ảnh quá lớn, vui lòng chọn ảnh có kích thước nhỏ hơn 5MB.");
                            return;
                        }

                        // Kiểm tra các trường có rỗng không
                        if (title == '' || summary == '' || content == '' || tags == '' || !imageFile) {
                            alert('Vui lòng điền đầy đủ thông tin');
                            return;
                        }

                        // Tạo một FormData object để gửi cả file và các trường dữ liệu khác
                        var formData = new FormData();
                        formData.append('_method', 'PUT');  // Đặt method PUT để Laravel hiểu đây là update
                        formData.append('title', title);
                        formData.append('summary', summary);
                        formData.append('content', content);
                        formData.append('status', status);
                        formData.append('tags', JSON.stringify(tags));
                        formData.append('comment_status', commentStatus);
                        formData.append('image', imageFile);

                        // In ra dữ liệu đã lấy từ form
                        console.log("Dữ liệu gửi lên server: ", formData);
                        //in chi tiết dữ liệu gửi lên
                        for (var pair of formData.entries()) {
                            console.log(pair[0] + ', ' + pair[1]);
                        }

                        // Gửi dữ liệu lên server (AJAX PUT)
                        $.ajax({
                            url: '/api/blog/' + id,  // Đảm bảo URL này chính xác cho việc update bài viết
                            method: 'POST',
                            data: formData,
                            processData: false,  // Không cần phải chuyển dữ liệu thành chuỗi
                            contentType: false,  // Không cần phải đặt content type, FormData sẽ tự xử lý
                            success: function(res) {
                                if (res.status == 200) {
                                    // Hiển thị thông báo cập nhật thành công
                                    $('#staus-notice').html(`
                                        <div class="alert alert-primary alert-dismissible fade show">
                                            Cập nhật bài viết thành công!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    `);

                                    setTimeout(function() {
                                        $('#staus-notice').html('');
                                        location.reload(); // Reload trang sau 3 giây
                                    }, 3000);
                                } else {
                                    $('#staus-notice').html(`
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            Có lỗi xảy ra: ${res.message}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    `);
                                }

                                // Gọi lại show để cập nhật
                                Post.show(id);
                            },
                            error: function(xhr, status, error) {
                                console.log("Có lỗi xảy ra trong quá trình gửi dữ liệu", error);
                                alert("Có lỗi xảy ra, vui lòng thử lại.");
                            }
                        });
                    });
                } else {
                    alert("Không tìm thấy bài viết.");
                }
            },
            error: function(xhr, status, error) {
                console.log("Có lỗi xảy ra khi lấy dữ liệu bài viết", error);
                alert("Không thể lấy dữ liệu bài viết, vui lòng thử lại.");
            }
        });
    };

    //get id từ link
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf('/') + 1);
    //update(id);

</script>


@endsection