@extends('manager.layout')
@section('page_title', 'Sản phẩm')
@section('page_css')
<link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('admin_assets/page/css/product.css')}}" rel="stylesheet">
<link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">

<!-- summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Sản phẩm</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="#">Quản lý sản phẩm</a>
                <span class="breadcrumb-item active">Sản phẩm</span>
            </nav>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" id="btn-add-product">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Sản phẩm hỏng</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="productsTable" class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Hình ảnh</th>
                            <th>Phân loại</th>
                            <th>Kho</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    

@endsection

@section('page_js')
<script src="{{asset('admin_assets/assets/vendors/select2/select2.min.js')}}"></script>
<script>
    $('.select2').select2();
</script>
<script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>
<script src="{{asset('admin_assets/summernote/summernote-lite.min.js')}}"></script>

<script src="{{asset('admin_assets/page/js/api.js')}}"></script>
<script src="{{asset('admin_assets/page/js/inventory.js')}}"></script>


@endsection
