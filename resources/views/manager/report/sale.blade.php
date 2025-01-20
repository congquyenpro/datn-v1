@extends('manager.layout')

@section('page_title', 'Tài chính')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/page/css/order.css')}}" rel="stylesheet">

    <link href="{{asset('admin_assets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Bán hàng</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="m-b-0 text-muted">Doanh thu tháng</p>
                            <h2 class="m-b-0" id="total-month-revenue"></h2>
                        </div>
                        <div>
                            <div class="btn-group">
                                <a href="{{route('manager.report.fin')}}" class="btn btn-default active">
                                    <span>Xem chi tiết</span>
                                </a>
                                <!--                                                 <button class="btn btn-default">
                                    <span>Year</span>
                                </button> -->
                            </div>
                        </div>
                    </div>
                    <div class="m-t-50" style="height: 330px">
                        <canvas class="chart" id="revenue-chart-2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 m-b-50">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="m-b-0 text-muted">Doanh thu năm</p>
                            <h2 class="m-b-0" id="revenue-average"></h2>
                        </div>
                        <div>
                  <!--           <span class="badge badge-pill badge-cyan font-size-15">
                                <span class="font-weight-semibold m-l-5"></span>
                            </span> -->
                        </div>
                    </div>
                    <div class="m-t-50" style="height: 375px">
                        <canvas class="chart" id="month-revenue-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--     <div class="row">
            <!-- 3 tables: type, age, sex -->
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 id="type_customer" class="m-b-0">Theo loại khách hàng</h5>
                        <div class="m-v-60 text-center" style="height: 200px">
                            <canvas class="ct-chart" id="customers-chart"></canvas>  <!-- Đảm bảo sử dụng <canvas> thay vì <div> -->
                        </div>
                        
                        <div class="row border-top p-t-25">
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-success badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!-- <h4 class="m-b-0">350</h4> -->
                                            <p class="m-b-0 muted">Mới</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-secondary badge-dot m-r-10"></span>
                                        <div class="m-l-3">
                                            <!-- <h4 class="m-b-0">450</h4> -->
                                            <p class="m-b-0 muted">Quay lại</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-warning badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!-- <h4 class="m-b-0">100</h4> -->
                                            <p class="m-b-0 muted">Khác</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-12 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="m-b-0">Theo độ tuổi</h5>
                        <div class="m-v-60 text-center" style="height: 200px">
                            <div class="ct-chart" id="donut-chart2"></div>
                        </div>
                        <div class="row border-top p-t-25">
                            <div class="col-3">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-success badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!-- <h4 class="m-b-0">350</h4> -->
                                            <p class="m-b-0 muted">18-25</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-secondary badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!-- <h4 class="m-b-0">450</h4> -->
                                            <p class="m-b-0 muted">25-35</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-warning badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!-- <h4 class="m-b-0">100</h4> -->
                                            <p class="m-b-0 muted">35-45</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-danger badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!-- <h4 class="m-b-0">100</h4> -->
                                            <p class="m-b-0 muted">50+</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-12 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="m-b-0">Theo giới tính</h5>
                        <div class="m-v-60 text-center" style="height: 200px">
                            <div class="ct-chart" id="donut-chart"></div>
                        </div>
                        <div class="row border-top p-t-25">
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-secondary badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!-- <h4 class="m-b-0">450</h4> -->
                                            <p class="m-b-0 muted">Nam</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-success badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!--  <h4 class="m-b-0">100</h4> -->
                                            <p class="m-b-0 muted">Nữ</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div class="media align-items-center">
                                        <span class="badge badge-Warning badge-dot m-r-10"></span>
                                        <div class="m-l-5">
                                            <!--  <h4 class="m-b-0">100</h4> -->
                                            <p class="m-b-0 muted">Unisex</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div> --}}
    
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                   <div class="d-flex justify-content-between align-items-center">
                        <h5>Sản phẩm bán chạy</h5>
                    </div>
                    <div class="m-t-30">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Sản phẩm</th>
                                        <th>Đã bán</th>
                                       
                                    </tr>
                                </thead>
                                <tbody id="best-selling-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-b-0">Thống kê kho</h5>
                        <div>
                            <a href="/admin/report/warehouse" class="btn btn-sm btn-default">View All</a>
                        </div>
                    </div>
                </div>
                <div class="m-t-10">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-today">Tồn kho</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-week1"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-month1"></a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-15">
                        <div class="tab-pane card-body fade active show" id="tab-today">
                            <div class="alert alert-primary">
                                <p class="font-weight-bold"> Số tồn kho:</p>
                                <p id="inventory-quantity"></p>
                            </div>
                            <div class="alert alert-primary">
                                <p class="font-weight-bold"> Giá trị tồn kho:</p>
                                <p id="inventory-value"></p>
                            </div>
                        </div>
                        <div class="tab-pane card-body fade" id="tab-week">
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-week-1" type="checkbox">
                                        <label for="task-week-1" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Verify connectivity</h5>
                                                <p class="m-b-0 text-muted font-size-13">Bugger bag
                                                    egg's old boy willy jolly</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-week-2" type="checkbox">
                                        <label for="task-week-2" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Order console machines</h5>
                                                <p class="m-b-0 text-muted font-size-13">Value
                                                    proposition alpha crowdsource</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-week-3" type="checkbox" checked="">
                                        <label for="task-week-3" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Customize Template</h5>
                                                <p class="m-b-0 text-muted font-size-13">Do you see any
                                                    Teletubbies in here</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-week-4" type="checkbox" checked="">
                                        <label for="task-week-4" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Batch schedule</h5>
                                                <p class="m-b-0 text-muted font-size-13">Trillion a very
                                                    small stage in a vast</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-week-5" type="checkbox" checked="">
                                        <label for="task-week-5" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Prepare implementation</h5>
                                                <p class="m-b-0 text-muted font-size-13">Drop in axle
                                                    roll-in rail slide</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane card-body fade" id="tab-month">
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-month-1" type="checkbox">
                                        <label for="task-month-1" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Create user groups</h5>
                                                <p class="m-b-0 text-muted font-size-13">Nipperkin run a
                                                    rig ballast chase</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-month-2" type="checkbox" checked="">
                                        <label for="task-month-2" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Design Wireframe</h5>
                                                <p class="m-b-0 text-muted font-size-13">Value
                                                    proposition alpha crowdsource</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-month-3" type="checkbox">
                                        <label for="task-month-3" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Customize Template</h5>
                                                <p class="m-b-0 text-muted font-size-13">I'll be sure to
                                                    note that</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-month-4" type="checkbox">
                                        <label for="task-month-4" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Management meeting</h5>
                                                <p class="m-b-0 text-muted font-size-13">Hand-crafted
                                                    exclusive finest</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-15">
                                <div class="d-flex align-items-center">
                                    <div class="checkbox">
                                        <input id="task-month-5" type="checkbox" checked="">
                                        <label for="task-month-5" class="d-flex align-items-center">
                                            <div class="inline-block m-l-10">
                                                <h5 class="m-b-0">Extend data model</h5>
                                                <p class="m-b-0 text-muted font-size-13">European minnow
                                                    priapumfish mosshead</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                   <div class="d-flex justify-content-between align-items-center">
                        <h5>Sản phẩm tiềm năng</h5>
                    </div>
                    <div class="m-t-30">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Sản phẩm</th>
                                        <th>Lượt xem</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="top-view-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    <script src="{{asset('admin_assets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $('.datepicker-input').datepicker();
    </script>
    
    <script src="{{asset('admin_assets/page/js/api.js')}}"></script>
    <script src="{{asset('admin_assets/page/js/report.sale.js')}}"></script>

@endsection