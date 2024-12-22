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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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
    <div class="container m-t-100">
        <div class="card">
            <div class="card-body ">

                <form>
                    <div class="form-group row">
                        <label for="inputOrderCode" class="col-sm-2 col-form-label font-size-18">Mã đơn hàng</label>
                        <div class="col-sm-12 col-md-10 d-flex align-items-center">
                            <input type="text" class="form-control" id="inputOrderCode" placeholder="Mã đơn">
                            <button type="submit" class="btn btn-primary m-l-10" id="add-order">Add</button>
                            <button type="submit" class="btn btn-primary m-l-10" id="add-order-2">Database</button>
                        </div>
                    </div>
                </form>

                <div class="text-center"><i class="fa fa-refresh fa-spin font-size-30" style="font-size:24px"></i></div>
                <div class="m-t-20 text-center"><h3>Cập nhật đơn hàng</h3></div>
                <div class="m-t-25" id="update-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="font-size-16 list-unstyled" id="order-queue">
<!--                                         <li class="d-flex justify-content-between align-items-center">
                                            Đơn hàng OD97
                                            <i class="anticon anticon-close-circle font-size-20"></i>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="font-size-16" id="update-content">
                                        <li style="list-style: none;">Đang cập nhật trạng thái...</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

    

    
    <script src="{{asset('admin_assets/assets/js/vendors.min.js')}}"></script>


    <!-- Core JS -->
    <script src="{{asset('admin_assets/assets/js/app.min.js')}}"></script>

    <script>
        // Xử lý cập nhật đơn hàng
    
        // Thêm vào order_queue
        $('#add-order').click(function(e) {
            e.preventDefault();
            var orderCode = $('#inputOrderCode').val();
            if (orderCode) {
                $('#order-queue').append(`
                    <li class="d-flex justify-content-between align-items-center" data-order="${orderCode}">
                        Đơn hàng ${orderCode}
                        <i class="anticon anticon-close-circle font-size-20"></i>
                    </li>
                `);
            }
        });

        $('#add-order-2').click(function(e) {
            e.preventDefault();

            // Gửi yêu cầu đến API để lấy danh sách đơn hàng
            $.ajax({
                url: 'http://127.0.0.1:8000/api/webhook/order/all?order_status=4', // API để lấy tất cả đơn hàng
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    // Kiểm tra nếu có đơn hàng trong response
                    if (response) {
                        // Lặp qua tất cả các đơn hàng và thêm chúng vào queue
                        response.forEach(function(order) {
                            var orderCode = order.shipping_code; // Giả sử API trả về "order_code"
                            $('#order-queue').append(`
                                <li class="d-flex justify-content-between align-items-center" data-order="${orderCode}">
                                    Đơn hàng ${orderCode}
                                    <i class="anticon anticon-close-circle font-size-20"></i>
                                </li>
                            `);
                        });
                    } else {
                        alert('Không có đơn hàng nào để hiển thị');
                    }
                },
                error: function(err) {
                    alert('Lỗi khi lấy dữ liệu đơn hàng: ' + err.statusText);
                }
            });
            $.ajax({
                url: 'http://127.0.0.1:8000/api/webhook/order/all?order_status=2', // API để lấy tất cả đơn hàng
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    // Kiểm tra nếu có đơn hàng trong response
                    if (response) {
                        // Lặp qua tất cả các đơn hàng và thêm chúng vào queue
                        response.forEach(function(order) {
                            var orderCode = order.shipping_code; // Giả sử API trả về "order_code"
                            $('#order-queue').append(`
                                <li class="d-flex justify-content-between align-items-center" data-order="${orderCode}">
                                    Đơn hàng ${orderCode}
                                    <i class="anticon anticon-close-circle font-size-20"></i>
                                </li>
                            `);
                        });
                    } else {
                        alert('Không có đơn hàng nào để hiển thị');
                    }
                },
                error: function(err) {
                    alert('Lỗi khi lấy dữ liệu đơn hàng: ' + err.statusText);
                }
            });
            $.ajax({
                url: 'http://127.0.0.1:8000/api/webhook/order/all?order_status=3', // API để lấy tất cả đơn hàng
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    // Kiểm tra nếu có đơn hàng trong response
                    if (response) {
                        // Lặp qua tất cả các đơn hàng và thêm chúng vào queue
                        response.forEach(function(order) {
                            var orderCode = order.shipping_code; // Giả sử API trả về "order_code"
                            $('#order-queue').append(`
                                <li class="d-flex justify-content-between align-items-center" data-order="${orderCode}">
                                    Đơn hàng ${orderCode}
                                    <i class="anticon anticon-close-circle font-size-20"></i>
                                </li>
                            `);
                        });
                    } else {
                        alert('Không có đơn hàng nào để hiển thị');
                    }
                },
                error: function(err) {
                    alert('Lỗi khi lấy dữ liệu đơn hàng: ' + err.statusText);
                }
            });
        });
        

    
        // Gửi request cập nhật đơn hàng từ order_queue lên server sau mỗi 5s
        setInterval(function() {
            var orderQueue = $('#order-queue li');
            if (orderQueue.length > 0) {
                var orderCode = $(orderQueue[0]).data('order');
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/webhook/order?order_code=' + orderCode,
                    type: 'GET',
                    success: function(data) {
                        // Cập nhật giao diện với kết quả từ server
                        $('#update-content').append(`
                            <div class="card">
                                <div class="card-body">
                                    <ul class="font-size-16">
                                        <li style="list-style: none;">Đơn hàng ${orderCode}: ${data.message}</li>
                                    </ul>
                                </div>
                            </div>
                        `);
    
                        // Di chuyển đơn hàng đã cập nhật xuống cuối hàng đợi
                        var updatedOrder = $('#order-queue li').first();
                        updatedOrder.appendTo('#order-queue'); // Di chuyển phần tử xuống cuối

                        //Kiểm tra nếu data.new_status == 5 hoặc 6 hoặc 7 thì xóa khỏi hàng đợi
                        if (data.new_status == 5 || data.new_status == 6 || data.new_status == 7) {
                            updatedOrder.remove();
                        }
    
                    },
                    error: function(err) {
                        // Cập nhật giao diện khi có lỗi
                        $('#update-content').append(`
                            <div class="card">
                                <div class="card-body">
                                    <ul class="font-size-16">
                                        <li style="list-style: none;">Đơn hàng ${orderCode}: Cập nhật thất bại - ${err.statusText}</li>
                                    </ul>
                                </div>
                            </div>
                        `);
    
                        // Di chuyển đơn hàng đã xử lý (thất bại) xuống cuối hàng đợi
                        var failedOrder = $('#order-queue li').first();
                        failedOrder.appendTo('#order-queue'); // Di chuyển phần tử xuống cuối
                    }
                });
            }
        }, 5000);
    
        // Hàm xóa order
        $('#order-queue').on('click', '.anticon-close-circle', function() {
            $(this).closest('li').remove();
        });
    
    </script>
    

</body>

</html>