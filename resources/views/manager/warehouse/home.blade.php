@extends('manager.layout')

@section('page_title', 'Kho hàng')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/page/css/order.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/page/css/product.css')}}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
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
                        <span>Tạo</span>
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
                                        <option selected>Loại</option>
                                        <option value="all">Tất cả</option>
                                        <option value="Burberry">Nhập</option>
                                        <option value="Calvin Klein">Hỏng</option>
                                    
                                    </select>
                                </div>
       
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover"  id="warehouse-history-table">
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
                                        <option selected>Tồn kho</option>
                                        <option value="all">Tất cả</option>
                                        <option value="Burberry">Hết hàng</option>
                                        <option value="Calvin Klein">Dưới 50</option>
                                        <option value="Christian Dior">Dưới 10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
{{--                         <div class="col-lg-4 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" id="btn-add-product">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Sản phẩm hỏng</span>
                            </button>
                        </div> --}}
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
    </div>

</div>

    <!-- Modal Chi tiết nhập -->
    <div class="modal fade bd-example-modal-xl" style="padding-left: 20px !important;" >
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 95%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Chi tiết phiếu</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-right m-b-20">
                            <button class="btn btn-primary" id="export-ticket">
                                <i class="fas fa-file-excel m-r-5"></i>
                                <span>Export</span>
                            </button>
                        </div>
                    </div>
                    <div id="ticket-detail"></div>
                    
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
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputType"></label>
                                            <select id="inputType" class="form-control">
                                                <option value="IN" selected>Nhập hàng</option>
                                                <option value="OUT">Hàng hỏng</option>
                                                <option value="OUT2" disabled>Xuất hàng (coming soon)</option>
                                            </select>
                                        </div>
                                    </div>
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
    <script src="{{asset('admin_assets/page/js/inventory.js')}}"></script>

@endsection