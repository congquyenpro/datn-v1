@extends('manager.layout')

@section('title','Đơn hàng')

@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/page/css/order.css')}}" rel="stylesheet">
    <style>
        #orders_list {
            width: 100%; /* Đảm bảo bảng sử dụng toàn bộ chiều rộng */
        }
    </style>

@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Đơn hàng</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-2 col-lg-2">
            <div class="card">
                <div class="card-body">
                    <div class="status-event is-select" atr="Pending" data-id="0">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-primary badge-dot m-r-10"></div>
                            <div>Tất cả</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>
                    <div class="status-event" atr="Pending" data-id="1">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-warning badge-dot m-r-10"></div>
                            <div>Chờ xử lý</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>
                    <div class="status-event" atr="Pending" data-id="2">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-warning badge-dot m-r-10"></div>
                            <div>Chưa hoàn thiện</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>
                    <div class="status-event" atr="Pending" data-id="3">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-info badge-dot m-r-10"></div>
                            <div>Đã hoàn thiện</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>
                    <div class="status-event" atr="Pending" data-id="4">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-secondary badge-dot m-r-10"></div>
                            <div>Chờ lấy hàng</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>
                    <div class="status-event" atr="Pending" data-id="5">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-secondary badge-dot m-r-10"></div>
                            <div>Đang giao hàng</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>
                    <div class="status-event" atr="Pending" data-id="6">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-info badge-dot m-r-10"></div>
                            <div>Đã giao hàng</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>
<!--                <div class="status-event" atr="Pending" data-id="7">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-success badge-dot m-r-10"></div>
                            <div>Hoàn thành</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div> 
-->
                    <div class="status-event" atr="Pending" data-id="8">
                        <div class="d-flex align-items-center">
                            <div class="badge badge-danger badge-dot m-r-10"></div>
                            <div>Hủy đơn</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>(333.045)</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10">
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
{{--
                    <div class="table-responsive">
                        <table id="products_table" class="table table-hover e-commerce-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox">
                                            <input id="checkAll" type="checkbox">
                                            <label for="checkAll" class="m-b-0"></label>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Khách hàng</th>
                                    <th>Đơn hàng</th>
                                    <th>Ngày đặt</th>
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
                                        <p><i class="far fa-user m-r-10"></i>Quyền Nguyễn</p>
                                        <p><i class="far fa-address-book m-r-10"></i>22, Hoàng Mai, Hà Nội</p>
                                        <p><i class="fas fa-phone-alt m-r-10"></i>0966320416</p>
                                    </td>
                                    <td>
                                        2.200.000₫
                                    </td>
                                    <td>
                                        06-10-2024
                                    </td>
                                    <td>
                                        <span class="badge m-b-5 badge-warning badge-pill">Chờ xử lý</span>
                                        <span class="badge m-b-5 badge-pill badge-green">Đã thanh toán</span>
                                        <span class="badge m-b-5 "></span>
                                    </td>
                                    <td class="text-right">
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                            <i class="anticon anticon-eye"></i>
                                        </button>
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                            <i class="anticon anticon-delete"></i>
                                        </button>
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
                                        #31
                                    </td>
                                    <td>
                                        <p><i class="far fa-user m-r-10"></i>Minh Hoàn</p>
                                        <p><i class="far fa-address-book m-r-10"></i>44, Nguyễn An Ninh, Hoàng Mai Hà Nội</p>
                                        <p><i class="fas fa-phone-alt m-r-10"></i>0966320416</p>
                                    </td>
                                    <td>
                                        2.200.000₫
                                    </td>
                                    <td>
                                        06-10-2024
                                    </td>
                                    <td>
                                        <span class="badge m-b-5 badge-warning badge-pill">Chờ xử lý</span>
                                        <span class="badge badge-pill badge-magenta">Chưa thanh toán</span>
                                        <span class="badge m-b-5 "></span>
                                    </td>
                                    <td class="text-right">
                                        <button class="btn btn-icon btn-hover btn-sm btn-rounded">
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
--}}
                    <div class="table-responsive">
                        <table class="table table-hover" id="orders_list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Khách hàng</th>
                                    <th>Đơn hàng</th>
                                    <th>Ngày đặt</th>
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
    </div>

    <div class="modal fade bd-example-modal-xl" style="padding-left: 20px !important;">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 95%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row border m-b-15" style=" padding: 15px; ">
                        <div class="col-md-6 col-lg-6">
                            <div class="d-md-flex align-items-center">
                                <div class="text-center text-sm-left ">
                                    <div class="avatar avatar-image" style="width: 150px; height:150px">
                                        <img src="https://static-00.iconduck.com/assets.00/user-icon-2048x2048-ihoxz4vq.png" alt="">
                                    </div>
                                </div>
                                <div class="text-center text-sm-left m-v-15 p-l-30">
                                    <h2 class="m-b-5 text-center customer-name">Nguyễn Công Quyền</h2>
                                </div>
                            </div>
                        </div>                   
                        <div class="col-md-6 col-lg-6 border-left ">
                            <div class="row">
                                <div class="d-md-block d-none border-left col-1"></div>
                                <div class="col">
                                    <ul class="list-unstyled m-t-10">
                                        <li class="row">
                                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-idcard"></i>
                                                <span>Nhóm KH: </span> 
                                            </p>
                                            <p class="col font-weight-semibold customer-type">Thành viên</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                                <span>Email: </span> 
                                            </p>
                                            <p class="col font-weight-semibold customer-email"> </p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                                <span>Điện thoại: </span> 
                                            </p>
                                            <p class="col font-weight-semibold customer-telephone">0966320416</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                                <span>Địa chỉ: </span> 
                                            </p>
                                            <p class="col font-weight-semibold customer-address">Đắk Lắk Scos Soc 12</p>
                                        </li>
                                        <li class="row">
                                        <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                            <i class="m-r-10 text-primary anticon anticon-shopping"></i>
                                            <span>Mã đơn: </span> 
                                        </p>
                                        <p class="col font-weight-semibold order-id-api">146</p>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-9 col-lg-9">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                  <tr class="table-info">
                                                    <th>Mã</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Giảm giá</th>
                                                    <th>Thành tiền</th>
                                                    <th>Kho</th>
                                                    <th>Ghi chú</th>
                                                  </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>37</td>
                                                    <td><a href="#" target="_blank">HERMÈS L’OMBRE DES MERVEILLES (100ml)</a></td>
                                                    <td>1</td>
                                                    <td>20000</td>
                                                    <td>10%</td>
                                                    <td>18000</td>
                                                    <td><div class="badge badge-red badge-pill m-r-10">250</div></td>
                                                    <td>Không giao hàng vào giờ hành chính từ t2-t6</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <select name="" id="" class="form-control order-status">
                                    <option value="2">Đã hoàn thiện</option><option value="7">Hủy đơn</option></select>
                                    <textarea class="form-control m-t-5" aria-label="With textarea" placeholder="Ghi chú"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>

<script src="{{asset('admin_assets/page/js/api.js')}}"></script>
<script src="{{asset('admin_assets/page/js/order.js')}}"></script>
@endsection