@extends('manager.layout')

@section('page_title', 'Kho hàng')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/page/css/order.css')}}" rel="stylesheet">
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Quản lý kho</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-12 col-md-2 col-lg-2">
            <div class="card">
                <div class="card-body">
                    <button data-toggle="modal" data-toggle="modal" data-target=".bd-example-modal-xl-2" class="btn btn-primary btn-tone">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Nhập</span>
                    </button>
                    <hr>
                    <div class="status-event template-item is-select" atr="Pending" data-id-template="0" style="cursor: pointer;">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-primary badge-dot m-r-10"></div>
                            <div>Lịch sử nhập</div>
                        </div>
                    </div>
                    <div class="status-event template-item" atr="Pending" data-id-template="1" style="cursor: pointer;">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-warning badge-dot m-r-10"></div>
                            <div>Kho hàng</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Lịch sử nhập -->
        <div  id="entry-history" class="col-sm-12 col-md-10 col-lg-10">
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
                                    <th>Người duyệt</th>
                                    <th>Tổng giá trị</th>
                                    <th>Ngày nhập</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-1" type="checkbox">
                                            <label for="check-item-1" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #31
                                    </td>
                                    <td>
                                        Nguyễn Công Quyền
                                    </td>
                                    <td>
                                        2.200.000₫
                                    </td>
                                    <td>
                                        06-10-2024 16:22
                                    </td>
                                    <td>
                                        <span class="badge m-b-5 badge-pill badge-green">Nhập hàng</span>
                                    </td>
                                    <td class="text-right">
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-toggle="modal" data-target=".bd-example-modal-xl">
                                            <i class="anticon anticon-eye"></i>
                                        </button>
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kho hàng -->
        <div  id="warehouse" class="col-sm-12 col-md-10 col-lg-10">
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
                                    <th>Tên sản phẩm</th>
                                    <th>Dung tích</th>
                                    <th>Giới tính</th>
                                    <th>Số lượng/Tổng</th>
                                    <th>Giá nhập</th>
                                    <th>Hạn sử dụng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-1" type="checkbox">
                                            <label for="check-item-1" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #31
                                    </td>
                                    <td>
                                        HERMÈS L’OMBRE DES MERVEILLES
                                    </td>
                                    <td>
                                        200ml
                                    </td>
                                    <td>
                                        Nam
                                    </td>
                                    <td>
                                        50/55
                                    </td>
                                    <td>
                                        2.000.000₫
                                    </td>
                                    <td>
                                        22-2-2025
                                    </td>


                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-1" type="checkbox">
                                            <label for="check-item-1" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #32
                                    </td>
                                    <td>
                                        HERMÈS L’OMBRE DES MERVEILLES
                                    </td>
                                    <td>
                                        200ml
                                    </td>
                                    <td>
                                        Nam
                                    </td>
                                    <td>
                                        5/55
                                    </td>
                                    <td>
                                        2.000.000₫
                                    </td>
                                    <td>
                                        22-2-2026
                                    </td>


                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <!-- Modal Chi tiết nhập -->
    <div class="modal fade bd-example-modal-xl" style="padding-left: 20px !important;">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 95%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Chi tiết nhập</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                  <tr class="table-info">
                                                    <th>ID</th>
                                                    <th>Ngày nhập</th>
                                                    <th>Tổng giá trị</th>
                                                    <th>Người xác nhận</th>
                                                  </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>1</td>
                                                    <td>4-11-2024 17:06:22</td>
                                                    <td>8.000.000₫</td>
                                                    <td>Nguyễn Công Quyền</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered">
                                            <thead>
                                                  <tr class="table-info">
                                                    <th>Mã SP</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Dung tích</th>
                                                    <th>Hạn sử dụng</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá nhập</th>
                                                    <th>Thành tiền</th>
                                                  </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>37</td>
                                                    <td>HERMÈS L’OMBRE DES MERVEILLES (100ml)</td>
                                                    <td>200</td>
                                                    <td>12-06-2025</td>
                                                    <td>10</td>
                                                    <td>400.000₫</td>
                                                    <td>4.000.000₫</td>
                                                </tr>
                                                <tr>
                                                    <td>37</td>
                                                    <td>HERMÈS L’OMBRE DES MERVEILLES (100ml)</td>
                                                    <td>200</td>
                                                    <td>12-06-2025</td>
                                                    <td>10</td>
                                                    <td>400.000₫</td>
                                                    <td>4.000.000₫</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <!-- <button type="button" class="btn btn-primary">Cập nhật</button> -->
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade bd-example-modal-xl-2" style="padding-left: 20px !important;">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 95%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Nhập hàng</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body ">
                                    <button class="btn btn-primary m-b-15" id="add-entry-item">
                                        <i class="anticon anticon-plus-circle m-r-5"></i>
                                        <span>Tạo mới</span>
                                    </button>
                                    <button class="btn btn-primary m-b-15" id="import">
                                        <i class="anticon anticon-upload"></i>
                                        <span>Import</span>
                                    </button>
                                    
                                    <div id="items-container">

                                    </div>
<!-- 
                                    <div class="item-entry m-t-20 border p-5 m-b-15" style=" border: dotted 1px #1391c3 !important;">
                                        <form>
                                            <div class="form-row">
                                                <div class="m-b-5 col-sm-6 col-md-2 col-lg-2">
                                                    <select class="select2 form-control" name="states[]" multiple="multiple">
                                                        <option value="AP">Nước hoa 1 Nước hoa 1 Nước hoa 1</option>
                                                        <option value="NL">Nước hoa 2</option>
                                                        <option value="BN">Nước hoa 3</option>
                                                        <option value="HL">Nước hoa 4</option>
                                                    </select>
                                                </div>
                                                <div class="m-b-5 col-sm-6 col-md-2 col-lg-2">
                                                    <select class="select2 form-control" name="states[]" multiple="multiple">
                                                        <option value="AP">100ml</option>
                                                        <option value="NL">200ml</option>
                                                        <option value="BN">300ml</option>
                                                    </select>
                                                </div>
                                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                                    <input type="text" class="form-control" placeholder="Số lượng">
                                                </div>
                                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                                    <input type="text" class="form-control" placeholder="Giá bán">
                                                </div>
                                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                                    <input type="text" class="form-control" placeholder="HSD: ngày-tháng-năm">
                                                </div>
                                                <div class="m-b-5 col-sm-3 col-md-2 col-lg-2">
                                                    <button class="btn btn-danger m-r-5"><i class="anticon anticon-delete"></i></button>
                                                </div>

                                            </div>
                                        </form>
                                    </div> -->


                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="save-import-btn">Lưu</button>
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
    
    <script src="{{asset('admin_assets/page/js/api.js')}}"></script>
    <script src="{{asset('admin_assets/page/js/warehouse.js')}}"></script>

@endsection