<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BKPerfume - Tra cứu đơn hàng</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('admin_assets/images/logo_banner/BKP.png')}}">


    <!-- Core css -->
    <link href="{{asset('admin_assets/assets/css/app.min.css')}}" rel="stylesheet">

    <style>
        .table-info, .table-info>th, .table-info>td {
            background-color: #f5f5f5;
        }

        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .footer {
            margin-top: auto; /* Đẩy footer xuống dưới */
            padding: 10px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .text-gray {
            color: #888;
        }

        .m-r-15 {
            margin-right: 15px;
        }
    </style>

</head>

<body>
    <div class="app is-folded">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="/">
                        <img src="{{asset('admin_assets/images/logo_banner/BKP.png')}}" alt="Logo">
                        <img class="logo-fold m-l-5" src="{{asset('admin_assets/images/logo_banner/BKP.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="/">
                        <img src="{{asset('admin_assets/images/logo_banner/BKP.png')}}" alt="Logo">
                        <img class="logo-fold" src="{{asset('admin_assets/images/logo_banner/BKP.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>    
            <!-- Header END -->

            <div class="container m-t-100">
                <div class="card">
                    <div class="card-body ">
                        <div class="m-t-20 m-b-50 text-center"><h1>TRA CỨU ĐƠN HÀNG</h1></div>
                        <form>
                            <div class="form-group row">
                                <!-- <label for="inputOrderCode" class="col-sm-2 col-form-label font-size-18">Mã đơn hàng</label> -->
                                <div class="col-sm-12 col-md-6 m-t-15">
                                    <input type="text" class="form-control" id="inputOrderCode" placeholder="Mã đơn">
                                </div>
                                <div class="col-sm-12 col-md-6 m-t-15">
                                    <input type="text" class="form-control" id="inputPhone" placeholder="Số điện thoại">
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="javascript:void(0)" type="submit" class="btn btn-primary float-right" id="lookup-btn">Tra cứu</a >
                            </div>
                        </form>
        
                        <div class="text-center"><i class="fa fa-refresh fa-spin font-size-30" style="font-size:24px"></i></div>
                        
                        <div class="row m-t-50" id="order-content">
<!--                             <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="2">THÔNG TIN ĐƠN HÀNG</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list"> 
                                                    <tr>
                                                        <td>Mã đơn hàng</td>
                                                        <td>BkPerfume</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ngày lấy dự kiến</td>
                                                        <td>12-12-2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ngày giao dự kiến</td>
                                                        <td>16-12-2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trạng thái hiện tại</td>
                                                        <td>16-12-2024</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body ">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th colspan="2">Thông tin chi tiết</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>Mã đơn khách hàng</td>
                                                    <td>94</td>
                                                </tr>
                                                <tr>
                                                    <td>Sản phẩm</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Lưu ý giao hàng</td>
                                                    <td>Cho thử hàng</td>
                                                </tr>
                                                <tr>
                                                    <td>Trả phí</td>
                                                    <td>Người gửi trả phí</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="2">Thông tin người nhận</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list"> 
                                                    <tr>
                                                        <td>Họ và tên</td>
                                                        <td>Công Quyền</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Điện thoại</td>
                                                        <td>0888222888</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Địa chỉ</td>
                                                        <td>Thôn 8/ Xã Tân Quang/ Huyện Văn Lâm/ Hưng Yên</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body ">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th colspan="3">Lịch sử đơn hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>Thứ 7, 07/12/2024</td>
                                                    <td>Chờ lấy hàng</td>
                                                    <td>122, Phường Trương Định, Quận Hai Bà Trưng, Hà Nội, Vietnam</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> -->
                        </div>
        
                    </div>
                </div>
            </div>

            <div class="m-t-25">
                <button class="btn btn-icon btn-primary btn-rounded float-right m-r-15">
                    <i class="anticon anticon-google"></i>
                </button>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content justify-content-between">
            <p class="m-b-0">BKPerfume</p>
            <span>
                <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                <a href="" class="text-gray">Privacy &amp; Policy</a>
            </span>
        </div>
    </footer>

    


    
   <!-- Core Vendors JS -->
   <script src="{{asset('admin_assets/assets/js/vendors.min.js')}}"></script>


    <!-- Core JS -->
    <script src="{{asset('admin_assets/assets/js/app.min.js')}}"></script>

    <script>
        //Thiết lập ajax với csrf token
/*         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); */
        //Gọi api
        const statusMap = {
            "ready_to_pick": "Tạo đơn hàng thành công",
            "picking": "Nhân viên đang lấy hàng",
            "cancel": "Hủy đơn hàng",
            "money_collect_picking": "Đang thu tiền người gửi",
            "picked": "Nhân viên đã lấy hàng",
            "storing": "Hàng đang nằm ở kho",
            "transporting": "Đang luân chuyển hàng",
            "sorting": "Đang phân loại hàng hóa",
            "delivering": "Nhân viên đang giao cho người nhận",
            "money_collect_delivering": "Nhân viên đang thu tiền người nhận",
            "delivered": "Nhân viên đã giao hàng thành công",
            "delivery_fail": "Nhân viên giao hàng thất bại",
            "waiting_to_return": "Đang đợi trả hàng về cho người gửi",
            "return": "Trả hàng",
            "return_transporting": "Đang luân chuyển hàng trả",
            "return_sorting": "Đang phân loại hàng trả",
            "returning": "Nhân viên đang đi trả hàng",
            "return_fail": "Nhân viên trả hàng thất bại",
            "returned": "Nhân viên trả hàng thành công",
            "exception": "Đơn hàng ngoại lệ không nằm trong quy trình",
            "damage": "Hàng bị hư hỏng",
            "lost": "Hàng bị mất"
        };
        const statusMap2 = {
            0: "Chờ xử lý",
            1: "Đã xác nhận",
            2: "Đã hoàn thiện",
            3: "Chờ lấy hàng",
            4: "Đang giao hàng",
            5: "Đã giao hàng",
            6: "Đã hủy",
            7: "Đã trả hàng"
        };

        // Hàm để hiển thị trạng thái dễ đọc
        function getReadableStatus(statusCode) {
            return statusMap[statusCode] || "Trạng thái không xác định";
        }
        function getReadableStatus2(statusCode) {
            return statusMap2[statusCode] || "Trạng thái không xác định";
        }


        $(document).ready(function(){
            $('#lookup-btn').click(function(){
                var orderCode = $('#inputOrderCode').val();
                var phone = $('#inputPhone').val();
                
                $.ajax({
                    url: '/api/webhook/order',
                    type: 'POST',
                    data: {
                        order_code: orderCode,
                        phone: phone
                    },
                    success: function(data){
                        if (data.code === 200) {
                            console.log(data.data);
                            if (data.shipping_type){
                                let order1 = data.data;
                                let productDetails = order1.order_items.map(item => `${item.product_size_info.product_name} x ${item.quantity}`).join(', ');
                                $('#order-content').html(`
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th colspan="2"><b>THÔNG TIN ĐƠN HÀNG</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="data-list">
                                                        <tr>
                                                            <td>Mã đơn hàng</td>
                                                            <td><b>${order1.shipping_code}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày đặt hàng</td>
                                                            <td><b>${order1.order_date.substring(0, 10)}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày dự kiến giao hàng</td>
                                                            <td><b>${(new Date(new Date(order1.order_date).setDate(new Date(order1.order_date).getDate() + 5))).toISOString().split('T')[0]}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trạng thái hiện tại</td>
                                                            <td><b>${getReadableStatus2(order1.status)}</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="2"><b>THÔNG TIN CHI TIẾT</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list">
                                                    <tr>
                                                        <td>Mã đơn KH</td>
                                                        <td><b>${order1.id}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sản phẩm</td>
                                                        <td><b>${productDetails}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lưu ý giao hàng</td>
                                                        <td><b>${order1.description}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trả phí</td>
                                                        <td><b>Người gửi trả phí</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th colspan="2"><b>THÔNG TIN NGƯỜI NHẬN</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="data-list">
                                                        <tr>
                                                            <td>Họ và tên</td>
                                                            <td><b>${order1.name}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Điện thoại</td>
                                                            <td><b>${order1.phone}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Địa chỉ</td>
                                                            <td><b>${order1.address.address}</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="3"><b>LỊCH SỬ ĐƠN HÀNG</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list">
                                                    ${order1.log && order1.log.length > 0 ? 
                                                        order1.log.map(function(logEntry) {
                                                            // Tách logEntry thành thời gian và mô tả
                                                            let [timestamp, ...descriptionParts] = logEntry.split(' - ');
                                                            let description = descriptionParts.join(' - ');

                                                            return `
                                                                <tr>
                                                                    <td><b>${timestamp}</b></td>
                                                                    <td>${description}</td>
                                                                    <td>-</td>
                                                                </tr>
                                                            `;
                                                        }).join('') 
                                                        : 
                                                        '<tr><td colspan="2">Không có lịch sử đơn hàng.</td></tr>'
                                                    }

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            `);
                                return;
                            }
                            let order = data.data;
                            // Cập nhật thông tin đơn hàng vào phần HTML
                            $('#order-content').html(`
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th colspan="2"><b>THÔNG TIN ĐƠN HÀNG</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="data-list">
                                                        <tr>
                                                            <td>Mã đơn hàng</td>
                                                            <td><b>${order.order_code}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày lấy dự kiến</td>
                                                            <td><b>${order.pickup_time.substring(0, 10)}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày giao dự kiến</td>
                                                            <td><b>${order.leadtime.substring(0, 10)}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trạng thái hiện tại</td>
                                                            <td><b>${getReadableStatus(order.status)}</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="2"><b>THÔNG TIN CHI TIẾT</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list">
                                                    <tr>
                                                        <td>Mã đơn KH</td>
                                                        <td><b>${order.client_order_code}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sản phẩm</td>
                                                        <td><b>${order.content}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lưu ý giao hàng</td>
                                                        <td><b>${order.required_note}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Trả phí</td>
                                                        <td><b>${order.payment_type_ids.includes(1) ? 'Người gửi trả phí' : 'Người nhận trả phí'}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th colspan="2"><b>THÔNG TIN NGƯỜI NHẬN</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="data-list">
                                                        <tr>
                                                            <td>Họ và tên</td>
                                                            <td><b>${order.to_name}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Điện thoại</td>
                                                            <td><b>${order.to_phone}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Địa chỉ</td>
                                                            <td><b>${order.to_address}</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="3"><b>LỊCH SỬ ĐƠN HÀNG</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list">
                                                    ${order.log && order.log.length > 0 ? 
                                                        order.log.map(function(logEntry) {
                                                            return `
                                                                <tr>
                                                                    <td><b>${new Date(logEntry.updated_date).toLocaleString()}</b></td>
                                                                    <td><b>${getReadableStatus(logEntry.status)}</b></td>
                                                                    <td><b>${logEntry.trip_code || "Không có mã chuyến"}</b></td>
                                                                </tr>
                                                            `;
                                                        }).join('') 
                                                        : 
                                                        '<tr><td colspan="3">Không có lịch sử đơn hàng.</td></tr>'
                                                    }
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            `);
                        } else {
                            alert('Đơn hàng không tồn tại hoặc số điện thoại không hợp lệ!'); // Thông báo lỗi từ API
                            console.log('Error: ' + data.message); // In thông báo lỗi từ API
                        }
                    },
                    error: function(xhr, status, error){
                        console.log('AJAX Error:', error); // In ra lỗi nếu có
                    }
                });
            });
        });



    </script>

</body>

</html>