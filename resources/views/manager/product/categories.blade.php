@extends('manager.layout')
@section('page_title', 'Danh mục')
@section('page_css')
<link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Danh mục</h4>
                    <div class="return-status">
                        @if ($errors->any())
                            <div class="alert alert-danger m-t-15">
                                <ul class="m-l-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success  m-t-15">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="card">
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
                    <button data-toggle="modal" data-target="#side-modal-right" class="btn btn-primary">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Danh mục</span>
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
                            <th>Tên</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $category)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="check-item-{{ $category->id }}" type="checkbox">
                                        <label for="check-item-{{ $category->id }}" class="m-b-0"></label>
                                    </div>
                                </td>
                                <td>
                                    #{{ $category->id }}
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal" data-target="#editCategoryModal" 
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-description="{{ $category->description}}">
                                        <i class="anticon anticon-edit"></i>
                                    </button>
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal" data-target="#deleteCategoryModal" data-id="{{ $category->id }}">
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
</div>
    <!-- Modal Add-->
    <div class="modal modal-right fade " id="side-modal-right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Thương hiệu</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form method="POST" action="{{route('manager.category.add')}}">
                    @csrf
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên danh mục*</label>
                                <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Tên danh mục" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Mô tả</label>
                                <input type="text" name="description" class="form-control" id="formGroupExampleInput" placeholder="Mô tả" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Sửa Danh Mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editCategoryForm" method="POST" action="{{ route('manager.category.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoryName">Tên Danh Mục</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                            <input type="hidden" id="categoryId" name="id">
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Mô tả</label>
                            <input type="text" class="form-control" id="categoryDescription" name="description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteCategoryForm" method="POST" action="{{ route('manager.category.delete') }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel">Xóa Danh Mục</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" id="deleteCategoryId" name="id">
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa danh mục này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

@endsection

@section('page_js')
<script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#editCategoryModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Nút đã nhấn
            var categoryId = button.data('id'); // Lấy ID
            var categoryName = button.data('name'); // Lấy tên
            var categoryDescription = button.data('description'); // Lấy mô tả

            var modal = $(this);
            modal.find('#categoryId').val(categoryId); // Điền ID vào input hidden
            modal.find('#categoryName').val(categoryName); // Điền tên vào input
            modal.find('#categoryDescription').val(categoryDescription); // Điền mô tả vào input
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#deleteCategoryModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Nút đã nhấn
            var categoryId = button.data('id'); // Lấy ID

            var modal = $(this);
            modal.find('#deleteCategoryId').val(categoryId); // Điền ID vào input hidden
        });
    });
</script>


@endsection
