@extends('manager.layout')

@section('page_title', 'Theo dõi khách hàng')

@section('page_css')
    <!-- page css -->
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Khách hàng</h4>
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
                            <select class="custom-select" id="customer-type-select" style="min-width: 180px;">
                                <option value="system" selected>Đã đăng ký</option>
                                <option value="other">Chưa có tài khoản</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="customer-list">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên hách hàng</th>
                            <th>Tổng chi tiêu</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-xl">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Thông tin khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">THÔNG TIN CÁ NHÂN</h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-9 col-lg-9">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                              <tr class="table-info">
                                                <th>Mã KH</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng chi tiêu</th>
                                              </tr>
                                        </thead>
                                        <tbody class="data-list"> 

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <select name="" id="status-select" class="form-control order-status">
                                            <option value="1">Hoạt động</option>
                                            <option value="0">Vô hiệu hóa</option>
                                        </select>
                                        <textarea class="form-control m-t-5" aria-label="With textarea" placeholder="Ghi chú"></textarea>
                                        <button class="d-flex btn btn-primary m-t-5 save-user-status" style="float: right;">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">ĐƠN HÀNG ĐÃ ĐẶT</h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-info">
                                                <th>Mã đơn hàng</th>
                                                <th>Mã vận chuyển</th>
                                                <th>Người nhận</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Ngày đặt</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-list-2"> 

                                        </tbody>
                                    </table>
                                </div>
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

    <script src="{{asset('admin_assets/page/js/api.js')}}"></script>
    <script src="{{asset('admin_assets/page/js/customer.js')}}"></script>
@endsection