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
    <div id="main-template" class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-8">
                    <div class="d-md-flex">
                        <div class="m-b-10 m-r-15">
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Catergory</option>
                                <option value="all">All</option>
                                <option value="Burberry">Burberry</option>
                                <option value="Calvin Klein">Calvin Klein</option>
                                <option value="Christian Dior">Christian Dior</option>
                            </select>
                        </div>
                        <div class="m-b-10">
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Status</option>
                                <option value="all">All</option>
                                <option value="inStock">In Stock</option>
                                <option value="outOfStock">Out of Stock</option>
                                <option value="outOfStock">Trending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <button id="create-post" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Thêm bài đăng</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Tác giả</th>
                            <th>Ngày đăng</th>
                            <th>Số lượt xem</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="check-item-{{ $post->id }}" type="checkbox">
                                        <label for="check-item-{{ $post->id }}" class="m-b-0"></label>
                                    </div>
                                </td>
                                <td>
                                    #{{ $post->id }}
                                </td>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td>
                                    @if($post->tags)
                                        @php
                                            // Tách chuỗi tags thành mảng sử dụng dấu phẩy làm phân cách
                                            $tags = explode(',', $post->tags);
                                        @endphp
                                    
                                        @foreach($tags as $tag)
                                            <span class="badge badge-pill badge-geekblue m-b-5">{{ trim($tag) }}</span>
                                        @endforeach
                                    @else
                                        <span>Không có tags</span>
                                    @endif
                                
                                </td>
                                
                                <td>
                                    {{ $post->user->name }} <!-- Lấy tên người dùng từ quan hệ -->
                                </td>
                                <td>
                                    {{ $post->created_at->format('d-m-Y') }} <!-- Hiển thị ngày tháng -->
                                </td>
                                <td>
                                    {{ $post->views }}
                                </td>
                                <td class="text-right">
                                    <a href="{{route('manager.blog.edit',$post->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded">
                                        <i class="anticon anticon-eye"></i>
                                    </a>
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded btn-delete-post" data-toggle="modal" data-target="#deleteModal" data-post-id="{{$post->id}}" data-title="{{ $post->title }}">
                                        <i class="anticon anticon-delete"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

    {{-- Delete modal --}}
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa bài đăng</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger submit-delete-post">Delete</button>
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
                    <button class="btn btn-default m-r-5 float-right" id="btn-cancel">Đóng</button>
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
                                            <input type="text" class="form-control" id="post-title" name="title" placeholder="Tiêu đề">
                                        </div>
                                        <div class="form-group">
                                            <label for="category-select">Chuyên mục</label>
                                            <select id="category-select" name="category" class="form-control">
                                                <option value="Kiến thức về nước hoa" selected>Kiến thức về nước hoa</option>
                                                <option value="Kinh nghiệm chọn nước hoa" >Kinh nghiệm chọn nước hoa</option>
                                                <option value="Góc review">Góc review</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="post-summary">Tóm tắt</label>
                                            <input type="text" class="form-control" id="post-summary" name="summary" placeholder="Tóm tắt">
                                        </div>
                                        <div class="form-group">
                                            <label for="post-content">Nội dung</label>
                                            <textarea id="summernote" name="content"></textarea>
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
                                                    <input type="radio" name="comment_status" id="comment-enable" value="enabled" checked>
                                                    <label for="comment-enable">
                                                        Bật
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="comment_status" id="comment-disable" value="disabled">
                                                    <label for="comment-disable">
                                                        Tắt
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="comment_status" id="comment-auto" value="auto">
                                                    <label for="comment-auto">
                                                        Tạo tự động
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                

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
                                                <option value="public" selected>Công khai</option>
                                                <option value="hidden">Ẩn</option>
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
                                        <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="post-image" id="post-image" width="100%">
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
                                    <input type="text" class="form-control" id="post-tags" placeholder="Các từ khóa cách nhau bởi dấu phẩy">
{{--                                     <div>
                                        <select class="select2" name="tags[]" multiple="multiple" id="post-tags">
                                            <option value="nước hoa">nước hoa</option>
                                            <option value="nước hoa nam">nước hoa nam</option>
                                            <option value="nước hoa Nữ">nước hoa nữ</option>
                                            <option value="nước hoa chính hãng">nước hoa chính hãng</option>
                                            <option value="nước hoa dior">nước hoa dior</option>
                                        </select>
                                    </div> --}}
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
    
    <script src="{{asset('admin_assets/page/js/api.js')}}"></script>
    <script src="{{asset('admin_assets/page/js/post.js')}}"></script>

@endsection