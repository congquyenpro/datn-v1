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
                    {{-- <button class="btn btn-danger btn-tone m-r-5 float-right" id="btn-delete">Xóa</button> --}}
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
                                            <label for="category-select">Chuyên mục</label>
                                            <select id="category-select" name="category" class="form-control">
                                                <option value="Kiến thức về nước hoa" @if($post->category == 'Kiến thức về nước hoa') selected @endif>Kiến thức về nước hoa</option>
                                                <option value="Kinh nghiệm chọn nước hoa" @if($post->category == 'Kinh nghiệm chọn nước hoa') selected @endif>Kinh nghiệm chọn nước hoa</option>
                                                <option value="Góc review" @if($post->category == 'Góc review') selected @endif>Góc review</option>
                                                <option value="Chính sách của hàng" @if($post->category == 'Chính sách của hàng') selected @endif>Chính sách của hàng</option>
                                            </select>
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
                                    <input type="text" class="form-control" id="post-tags" placeholder="Các từ khóa cách nhau bởi dấu phẩy" 
                                        value="{{ is_array($post->tags) ? implode(',', $post->tags) : $post->tags }}">
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

<script src="{{asset('admin_assets/page/js/api.js')}}"></script>
<script>
    // Hàm hiển thị bài viết
    function showPost(id) {
        console.log("showing post with id: " + id);
    }

    // Hàm thêm bài viết mới (bật/tắt form đăng bài)
    function addPost() {
        
        $('#create-post').on('click', function() {       
            $('#post-template').show();
            $('#main-template').hide();
        });

        // Hủy bỏ form đăng bài
        $('#btn-cancel').on('click', function() {
            $('#main-template').show();
            $('#post-template').hide();
        });

        // Nút xem hướng dẫn đăng bài
        $('#post-guild').hide();
        $('#view-post-guild').on('click', function() {
            $('#post-guild').toggle();
            if ($('#post-guild').is(':visible')) {
                this.innerHTML = 'Ẩn hướng dẫn';
            } else {
                this.innerHTML = 'Xem hướng dẫn';
            }
        });
    }

    // Hàm gửi dữ liệu bài viết (submit bài)
    function submitPost() {
        $('#btn-save').on('click', function() {
            var title = $('#post-title').val();  // Tiêu đề
            var summary = $('#post-summary').val();  // Tóm tắt
            var content = $('textarea[name="content"]').val();  // Nội dung (editor)
            var status = $('#post-status').val();  // Trạng thái
            var category = $('#category-select').val();  // Danh mục
            var tags = $('#post-tags').val();  // Từ khóa
            var commentStatus = $('input[name="comment_status"]:checked').val();  // Trạng thái bình luận
            var imageFile = $('#customFile')[0].files[0];  // Lấy file ảnh từ input
            
            // Kiểm tra kích thước file ảnh
            if (imageFile && imageFile.size > 5 * 1024 * 1024) {
                alert("Ảnh quá lớn, vui lòng chọn ảnh có kích thước nhỏ hơn 5MB.");
                return;
            }

            // Kiểm tra các trường có rỗng không
            if (title == '' || summary == '' || content == '' || tags == '') {
                alert('Vui lòng điền đầy đủ thông tin');
                return;
            }
            // Lấy đường dẫn của URL
            var path = window.location.pathname;

            // Tách đường dẫn và lấy ID từ cuối
            var pathSegments = path.split('/');

            // Lấy phần cuối cùng trong đường dẫn, chính là ID
            var postId = pathSegments[pathSegments.length - 1];

            // Kiểm tra nếu postId là một số hợp lệ
            if (!isNaN(postId) && parseInt(postId) > 0) {
                // Nếu ID hợp lệ, sử dụng postId
                console.log("ID bài viết:", postId);
            } else {
                // Nếu không hợp lệ, xử lý lỗi (ví dụ: hiển thị thông báo lỗi hoặc chuyển hướng)
                console.error("ID không hợp lệ");
            }


            // Tạo một FormData object để gửi cả file và các trường dữ liệu khác
            var formData = new FormData();
            formData.append('title', title);
            formData.append('summary', summary);
            formData.append('content', content);
            formData.append('status', status);
            formData.append('category', category);
            formData.append('tags', tags);
            formData.append('comment_status', commentStatus);
            if (imageFile) {
                formData.append('image', imageFile);  // Thêm file ảnh vào FormData
            }  // Thêm file ảnh vào FormData
            formData.append('id', postId);  // Thêm ID bài viết vào FormData
        
            // In ra dữ liệu đã lấy từ form
            console.log("Dữ liệu gửi lên server: ", formData);

            // Gửi dữ liệu lên server qua API
            Api.Blog.update(formData).done(function(res) {
                if (res.status == 201) {
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
                        location.reload();
                    }, 3000); // delay 3s
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
                showPost(1);
            });
        });
    }

    // Hàm tìm kiếm từ khóa trending
    function keywordSearch() {
        $('#trending-search').on('click', function() {
            var keyword = $('#trending-keyword').val();

            // Chuyển đến trang tìm kiếm với từ khóa
            window.open('https://trends.google.com/trends/explore?geo=VN&q=' + keyword, '_blank');
        });
    }

    // Hàm tải ảnh lên
    function uploadImage() {
        $('#customFile').on('change', function(event) {
            // Lấy file được chọn từ input
            var file = event.target.files[0];
            
            // Kiểm tra xem file có hợp lệ không (kiểu ảnh)
            if (file && file.type.startsWith('image/')) {
                // Tạo URL đối tượng cho file hình ảnh
                var reader = new FileReader();
                
                // Khi file đã được đọc xong, hiển thị hình ảnh
                reader.onload = function(e) {
                    // Cập nhật nguồn hình ảnh cho thẻ img
                    $('#post-image').attr('src', e.target.result);
                };
                
                // Đọc file dưới dạng URL
                reader.readAsDataURL(file);
                
                // Cập nhật label của input file
                var fileName = file.name;
                $('.custom-file-label').text(fileName);
            } else {
                alert('Vui lòng chọn một tệp hình ảnh');
            }
        });
    }

    // Gọi các hàm sau khi DOM đã được tải
    $(document).ready(function() {
        showPost(1); // Hiển thị bài viết với id = 1
        addPost(); // Thêm bài viết
        submitPost(); // Đăng bài
        keywordSearch(); // Tìm kiếm từ khóa trending
        uploadImage(); // Tải ảnh lên
    });

</script>


@endsection