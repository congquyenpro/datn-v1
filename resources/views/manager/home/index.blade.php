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
@endsection

@section('page_content')
<div class="main-content">
    <div class="row">
        <div class="col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><b>KẾT QUẢ KINH DOANH TRONG NGÀY</b></div>
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
                            <div class="card-title"><b>DOANH THU BÁN HÀNG</b></div>
                            <hr>
                            <!-- Range Datepicker-->
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Tổng quan báo cáo</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control datepicker-input" name="start" placeholder="From">
                                            <span class="p-h-10">to</span>
                                            <input type="text" class="form-control datepicker-input" name="end" placeholder="To">
                                            <button class="btn btn-default m-l-5"><i class="anticon anticon-file-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><b>THỐNG KÊ</b></div>
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
                <div class="col-sm-12 col-md-12 col-lg-12">
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
                                                <th>Sản phẩm</th>
                                                <th>Đã bán</th>
                                                <th>Doanh thu</th>
                                                <th style="max-width: 70px">Tồn kho</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Gray Sofa</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>81</td>
                                                <td>$1,912.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-success" style="width: 82%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            82
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Gray Sofa</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>26</td>
                                                <td>$1,377.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-success" style="width: 61%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            61
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Wooden Rhino</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>71</td>
                                                <td>$9,212.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-danger" style="width: 23%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            23
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Red Chair</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>79</td>
                                                <td>$1,298.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-warning" style="width: 54%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            54
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Wristband</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>60</td>
                                                <td>$7,376.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-success" style="width: 76%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            76
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between align-items-center">
                                <h5><b>SẢN PHẨM XU HƯỚNG</b></h5>
                            </div>
                            <div class="m-t-30">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Đã bán</th>
                                                <th>Doanh thu</th>
                                                <th style="max-width: 70px">Tồn kho</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Gray Sofa</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>81</td>
                                                <td>$1,912.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-success" style="width: 82%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            82
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Gray Sofa</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>26</td>
                                                <td>$1,377.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-success" style="width: 61%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            61
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Wooden Rhino</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>71</td>
                                                <td>$9,212.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-danger" style="width: 23%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            23
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Red Chair</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>79</td>
                                                <td>$1,298.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-warning" style="width: 54%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            54
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image rounded">
                                                            <img src="https://placehold.co/128x128" alt="">
                                                        </div>
                                                        <div class="m-l-10">
                                                            <span>Wristband</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>60</td>
                                                <td>$7,376.00</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress progress-sm w-100 m-b-0">
                                                            <div class="progress-bar bg-success" style="width: 76%"></div>
                                                        </div>
                                                        <div class="m-l-10">
                                                            76
                                                        </div>
                                                    </div>
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
        </div>
    </div>
</div>
@endsection

@section('page_js')
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
@endsection
