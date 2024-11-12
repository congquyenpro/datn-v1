@extends('manager.layout')
@section('page_title', 'Trang chủ')
@section('page_css')
<style>
    /* Đặt chiều cao cho biểu đồ */
    canvas {
        max-width: 6000px;
        max-height: 4000px;
    }
</style>
<link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('admin_assets/page/css/order.css')}}" rel="stylesheet">

<link href="{{asset('admin_assets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
@endsection

@section('page_content')
<div class="main-content">
    <div class="row">
        <div class="col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><b>DOANH THU NGÀY</b></div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-icon avatar-lg avatar-blue">
                                                    <i class="anticon anticon-dollar"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h4 class="m-b-0">20,000,000₫</h4>
                                                    <p class="m-b-0 text-muted">Doanh thu</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-icon avatar-lg avatar-blue">
                                                    <i class="anticon anticon-dollar"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h4 class="m-b-0">50</h4>
                                                    <p class="m-b-0 text-muted">Đơn hàng</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-icon avatar-lg avatar-blue">
                                                    <i class="anticon anticon-dollar"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h4 class="m-b-0">20</h4>
                                                    <p class="m-b-0 text-muted">Khách hàng</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><b>DOANH THU THÁNG</b></div>
                            
                            <!-- Range Datepicker-->
                            <div>
                                <h4 class="m-b-0" id="total-month-revenue"></h4>
                            </div>
                            <hr>
                            <div class="m-t-50" style="height: 330px">
                                <canvas class="chart" id="revenue-chart-2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><b>THỐNG KÊ HỆ THỐNG (Coming soon)</b></div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                                    <i class="anticon anticon-line-chart"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h4 class="m-b-0">Phiên truy cập</h4>
                                                    <p class="m-b-0 text-muted"><b>3.068</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                                    <i class="anticon anticon-line-chart"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h4 class="m-b-0">Trang/Phiên</h4>
                                                    <p class="m-b-0 text-muted"><b>1.76</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                                    <i class="anticon anticon-line-chart"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h4 class="m-b-0">Tỷ lệ bỏ trang</h4>
                                                    <p class="m-b-0 text-muted"><b>80.2%</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between align-items-center">
                                <h5><b>SẢN PHẨM BÁN CHẠY</b></h5>
                            </div>
                            <div class="m-t-30">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sản phẩm</th>
                                                <th>Đã bán</th>
                                                <th>Doanh thu</th>
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
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between align-items-center">
                                <h5><b>SẢN PHẨM TIỀM NĂNG</b></h5>
                            </div>
                            <div class="m-t-30">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sản phẩm</th>
                                                <th>Lượt xem</th>
                                                <th>Doanh thu</th>
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
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><b>BKECM NEWS</b></div>
                    <hr>
                    <div class="row m-b-15">
                        <div class="col-sm-4 col-md-4">
                            <div class="img-news m-t-5">
                                <img src="https://placehold.co/100x100" alt="" srcset="" width="100%" height="50px">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <h6><a href="http://">Tích hợp cổng thanh toán Sepay</a> <p style="font-size: 12px;">5/10/2024</p></h6>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><b>BKECM HOT</b></div>
                    <hr>
                    <div class="row m-b-15">
                        <div class="col-sm-4 col-md-4">
                            <div class="img-news m-t-5">
                                <img src="https://placehold.co/100x100" alt="" srcset="" width="100%" height="50px">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <h6><a href="http://">Giải pháp Marketing Zalo hiệu quả</a> <p style="font-size: 12px;">5/10/2024</p></h6>
                            
                        </div>
                        
                    </div>
                    <div class="row m-b-15">
                        <div class="col-sm-4 col-md-4">
                            <div class="img-news m-t-5">
                                <img src="https://placehold.co/100x100" alt="" srcset="" width="100%" height="50px">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <h6><a href="http://">Hội thảo xây dựng thương hiệu</a> <p style="font-size: 12px;">5/10/2024</p></h6>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-b-0">Thống kê kho</h5>
                        <div>
                            <a href="/admin/warehouse" class="btn btn-sm btn-default">Xem</a>
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
    </div>
</div>
@endsection

@section('page_js')
<script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>

<script src="{{asset('admin_assets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
    // Thiết lập dữ liệu cho biểu đồ
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Chọn loại biểu đồ là cột dọc
        data: {
            labels: ['7/10', '8/10', '9/10', '10/10', '11/10', '12/10', '13/10'], // Nhãn cho các cột
            datasets: [{
                label: 'Doanh thu theo ngày', // Nhãn cho tập dữ liệu
                data: [65, 59, 80, 81, 56, 55, 40], // Dữ liệu cho các cột
                backgroundColor: [
                    '#c2e8f5',
                    '#c2e8f5',
                    '#c2e8f5',
                    '#c2e8f5',
                    '#c2e8f5',
                    '#c2e8f5',
                    '#c2e8f5',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Bắt đầu trục y từ 0
                }
            }
        }
    });
</script>

<script>
    $('.datepicker-input').datepicker();
</script>

<script src="{{asset('admin_assets/page/js/api.js')}}"></script>
<script src="{{asset('admin_assets/page/js/home.js')}}"></script>
@endsection
