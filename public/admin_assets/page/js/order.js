
const Order = {
    orderList: {
        show: () => {
            Order.orderList.countOrder();

            $(document).on('click', '.status-event', function() {

                //Lọc theo tháng
                var timeframe = $('#month-select').val();

                Order.orderList.countOrder();
                var status = $(this).data('id');
                //gắn cho class status-event is-active
                $('.status-event').removeClass('is-select');
                $(this).addClass('is-select');
                Order.orderList.getOrdersList(status, timeframe);

                //off change event
/*                 $('#month-select').off('change');
                $('#month-select').on('change', function() {
                    timeframe = $(this).val();
                    Order.orderList.getOrdersList(status, timeframe);
                }); */
            });

            //Khởi tạo
            var init_status = 0;
            $('.status-event[data-id="' + init_status + '"]').trigger('click');
        },
        getOrdersList: (status, timeframe) => {
            Api.Order.GetOrdersList(status, timeframe).done((response) => {
                console.log(response);
                var order_status = [
                    `<span class="badge m-b-5 mr-1 badge-orange badge-pill">Chờ xử lý</span>`,
                    '<span class="badge m-b-5 mr-1 badge-cyan badge-pill">Đã xác nhận</span>',
                    '<span class="badge m-b-5 mr-1 badge-geekblue badge-pill">Đã hoàn thiện</span>',
                    '<span class="badge m-b-5 mr-1 badge-gold badge-pill">Chờ lấy hàng</span>',
                    '<span class="badge m-b-5 mr-1 badge-purple badge-pill">Đang giao hàng</span>',
                    '<span class="badge m-b-5 mr-1 badge-success badge-pill">Đã giao hàng</span>',
                    '<span class="badge m-b-5 mr-1 badge-danger badge-pill">Đã hủy</span>',
                    '<span class="badge m-b-5 mr-1 badge-danger badge-pill">Hoàn trả</span>',
                ];
                var payment_status = [
                    `<span class="badge m-b-5 mr-1 badge-warning badge-pill">Chưa thanh toán</span>`,
                    `<span class="badge m-b-5 mr-1 badge-success badge-pill">Đã thanh toán</span>`,
                ];
                const formattedData = response.map(order => ({
                    id: order.id,
                    name: `
                        <p><i class="far fa-user m-r-10"></i>${order.name}</p>
                        <p><i class="far fa-address-book m-r-10"></i>${JSON.parse(order.address).address.replace(/\//g, ',')}</p>
                        <p><i class="fas fa-phone-alt m-r-10"></i>${order.phone}</p>
                    `,
                    order_price: order.value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }), // Định dạng giá
                    order_date: order.order_date,
                    status: order_status[order.status] + payment_status[order.payment_status], // nếu đơn hàng đã giao thì trạng thái thanh toán => đã thanh toán
                    action: `
                    <button class="btn btn-icon btn-hover btn-sm btn-rounded view-order" data-id="${order.id}" data-status="${order.status}" >
                        <i class="anticon anticon-eye"></i>
                    </button>
                    `
                }));
                const formattedData_Test = response.map(order => {
                    // Kiểm tra nếu order.status là 5 thì gán payment_status = 1
                    let paymentStatus = order.payment_status;
                    if (order.status === 5) {
                        paymentStatus = 1;
                    }
                
                    return {
                        id: order.id,
                        name: `
                            <p><i class="far fa-user m-r-10"></i>${order.name}</p>
                            <p><i class="far fa-address-book m-r-10"></i>TEST</p>
                            <p><i class="fas fa-phone-alt m-r-10"></i>${order.phone}</p>
                        `,
                        order_price: order.value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }), // Định dạng giá
                        order_date: order.order_date,
                        status: order_status[order.status] + payment_status[paymentStatus], // Nếu đơn hàng đã giao thì trạng thái thanh toán => đã thanh toán
                        action: `
                            <button class="btn btn-icon btn-hover btn-sm btn-rounded view-order" data-id="${order.id}" data-status="${order.status}" >
                                <i class="anticon anticon-eye"></i>
                            </button>
                        `
                    };
                });
                
                $('#orders_list').DataTable({
                    data: formattedData,
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'order_price' },
                        { data: 'order_date' },
                        { data: 'status' },
                        { data: 'action' }
                    ],
                    autoWidth: false ,
                    responsive: true,
                    destroy: true, //Thêm destroy để reset bảng trước khi select status_type mới
                });
            });
        },
        viewDetail: () => {
            $(document).on('click', '.view-order', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                $('.bd-example-modal-xl').modal('show');
                Order.template.showDefault(id).then(() => {
                    switch (status) {
                        case 0:
                            Order.update.updateDefaultStatus();
                            break;
                        case 1:
                            Order.template.showPendingPage(id);
                            Order.update.updateDefaultStatus();
                            Order.update.updatePendingStatus();
                            break;
                        case 2:
                            Order.template.showPackagPage(id);
                            Order.update.updateDefaultStatus();
                            break;
                        case 3:
                            Order.template.showShippingPage(id);
                            $('#order_status_update').html(`
                                <option value="1">Đã xác nhận</option>
                                <option value="2">Đã hoàn thiện</option>
                                <option value="3">Chờ lấy hàng</option>
                                <option value="4"selected>Đang giao hàng</option>
                                <option value="5">Đã giao hàng</option>
                                <option value="6">Đã hủy</option>
                            `);
                            //Order.template.showPendingShippingPage();
                            Order.update.updateDefaultStatus();
                            break;
                        case 4:
                            Order.template.showShippingPage(id);
                            Order.update.updateDefaultStatus();
                            break;
                        case 5:
                            Order.template.showShippingPage(id);
                            Order.update.updateDefaultStatus();
                            break;
                        case 6:
                            Order.template.showShippingPage(id);
                            $('#order_status_update').html(`
                                <option value="1">Đã xác nhận</option>
                                <option value="2">Đã hoàn thiện</option>
                                <option value="3">Chờ lấy hàng</option>
                                <option value="4">Đang giao hàng</option>
                                <option value="5">Đã giao hàng</option>
                                <option value="6" selected>Đã hủy</option>
                            `);
                            break;
                        default:
                            Order.template.showShippingPage(id);
                            $('#order_status_update').html(`
                                <option value="1">Đã xác nhận</option>
                                <option value="2">Đã hoàn thiện</option>
                                <option value="3">Chờ lấy hàng</option>
                                <option value="4">Đang giao hàng</option>
                                <option value="5">Đã giao hàng</option>
                                <option value="6">Đã hủy</option>
                                <option value="7" selected>Hoàn trả</option>
                            `);
                            break;
                    }
                });

                //console.log(status);


            });
        },
        countOrder: () => {
            Api.Order.CountOrder().done((response) => {
                console.log(response);
                response.forEach((element, index) => {
                    $(`#status-${element.status}`).text(`(${element.count})`);
                });
            });
        },
        showByMonth: () => {
            var timeframe = $('#month-select').val();
            Order.orderList.show(timeframe);

            $('#month-select').change(function() {
                timeframe = $(this) .val();
                Order.orderList.show(timeframe);
            });
            
        },
        formatAddress: (address) => {
            var address = JSON.parse(address).address;
            //thay / bằng dấu ,
            return address.replace(/\//g, ',');
        }
    },
    template: {
        showDefault: (id) => {
            return Api.Order.GetOrderDetail(id).done((response) => {
                var items_list = response.order_items;
                console.log(items_list);
                $('#order-detail-body').html(`
                <div class="row border m-b-15" style=" padding: 15px; ">
                <div class="col-md-6 col-lg-6">
                    <div class="d-md-flex align-items-center">
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                <img src="https://static-00.iconduck.com/assets.00/user-icon-2048x2048-ihoxz4vq.png" alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5 text-center customer-name">${response.name}</h2>
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
                                        <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                        <span>Điện thoại: </span> 
                                    </p>
                                    <p class="col font-weight-semibold customer-telephone">${response.phone ?? ''}</p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                        <i class="m-r-10 text-primary anticon anticon-compass"></i>
                                        <span>Địa chỉ: </span> 
                                    </p>
                                    <p class="col font-weight-semibold customer-address">${response.address.address ?? ''}</p>
                                </li>
                                <li class="row">
                                <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                    <i class="m-r-10 text-primary anticon anticon-shopping"></i>
                                    <span>Mã đơn: </span> 
                                </p>
                                <p class="col font-weight-semibold order-id-api">${response.id ?? ''}</p>
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
                                          </tr>
                                    </thead>
                                    <tbody class="data-list"> 
                                        ${items_list.map(item => `
                                            <tr>
                                                <td>${item.product_size_id}</td>
                                                <td><a href="#" target="_blank">${item.product_size_info.product_name} (${item.product_size_info.product_size_name}ml)</a></td>
                                                <td>${item.quantity}</td>
                                                <td>${item.product_size_info.product_size_price + item.product_size_info.product_size_price*item.product_size_info.product_size_discount/100}</td>
                                                <td>${item.product_size_info.product_size_discount}</td>
                                                <td>${item.product_size_info.product_size_price*item.quantity}</td>
                                                <td><div class="badge badge-red badge-pill m-r-10">250</div></td>
                                            </tr>
                                        `)}
                                        <tr class="">
                                            <td colspan="5" ><strong>Tổng cộng:</strong></td>
                                            <td colspan="3"><strong>${response.value}</strong></td>
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
                            <select name="order_status" id="order_status_update" class="form-control order-status">
                                <option value="1" selected>Đã xác nhận</option>
                                <option value="2">Đã hoàn thiện</option>
                                <option value="3">Chờ lấy hàng</option>
                                <option value="4">Đang giao hàng</option>
                                <option value="5">Đã giao hàng</option>
                                <option value="6">Đã hủy</option>
                            </select>
                            <textarea id="order_note" class="form-control m-t-5" aria-label="With textarea" placeholder="Ghi chú">${response.description ?? ''}</textarea>
                        </div>
                    </div>
                </div>
            </div>
                `);
                $('#save-order-btn').attr('data-id', response.id);
            });
        },
        showPendingPage: (id) => {
            //sửa các options trong select có name "order_status" ở trang showDefault
            $('#order_status_update').html(`
                <option value="1">Đã xác nhận</option>
                <option value="2" selected >Đã hoàn thiện</option>
                <option value="3">Đang giao hàng</option>
                <option value="4">Đã giao hàng</option>
                <option value="6">Đã hủy</option>
            `);
            $('#order-detail-body').append(`
                <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-body d-flex">   
                            
                            <select name="" id="" class="form-control shipping-partner">                             
                                <option value="1">Giao Hàng Nhanh</option>
                                <option value="2" disabled>Giao Hàng Tiết Kiệm</option>
                                <option value="3">Khác</option>
                            </select>
                            <button style="white-space: nowrap;" class="btn btn-primary btn-tone m-l-5">                                        
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Tạo phiếu</span>
                            </button>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Phiếu giao hàng -->
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">THÔNG TIN GIAO HÀNG</h4>
                </div>
                <div class="row p-5">
                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Thông tin gói hàng </h5>
                                <p class="m-b-20">(Mặc định theo cấu hình tại: Cấu hình -> Giao hàng)</p>
                                
                                <form action="" method="post">
                                    <input type="hidden" name="_token" value="LwWv2HobMbboa1IeIc9QvV5ZMS4z6XjqfcdGcIOt">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputLong">Dài(*)</label>
                                            <input name="length" type="text" class="form-control" id="length" placeholder="" value="30">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputWidth">Rộng(*)</label>
                                            <input name="width" type="text" class="form-control" id="width" placeholder="Width" value="10">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputHeight">Cao(*)</label>
                                            <input name="height" type="text" class="form-control" id="Height" placeholder="Height" value="10">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Khối lượng</label>
                                        <div class="radio">
                                            <input type="radio" name="massOption" id="gridRadios1" value="option1">
                                            <label for="gridRadios1">
                                                Theo sản phẩm theo đơn hàng 
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="massOption" id="gridRadios2" value="option2" checked="">
                                            <label for="gridRadios2">
                                                Tùy chỉnh
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Nhập khối lượng tùy
                                            chỉnh (gam)</label>
                                        <input name="mass" type="text" class="form-control" id="weight" placeholder="Nhập khối lượng" value="500">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Yêu cầu</label>
                                        <select name="role" id="required_note" class="form-control">
                                            <option value="CHOTHUHANG">Cho xem hàng, cho thử</option>
                                            <option value="KHONGCHOXEMHANG">Không cho xem hàng</option>
                                            <option value="CHOXEMHANGKHONGTHU">Cho xem hàng, không cho thử
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ghi chú</label>
                                        <input name="note" type="text" class="form-control" id="note" placeholder="Ghi chú" value="">
                                    </div>
                                    <div class="row m-b-30">
                                        <div class="col-lg-6">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center m-b-10">
                                    <h5>Thông tin người gửi</h5>
                                </div>
                                <form action="" method="post">
                                    <input type="hidden" name="_token" value="LwWv2HobMbboa1IeIc9QvV5ZMS4z6XjqfcdGcIOt">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Địa chỉ kho gửi
                                                hàng:</label>
                                            <select id="inputWarehouse" class="form-control">
                                                <option selected="">Chọn kho</option>
                                                <option value="1" selected="">Kho Trương Định, Quận Hai Bà Trưng, Hà
                                                    Nội, 167</option>
                                                <option value="2">Kho Ecopark, Hưng Yên</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputShift">Ca lấy hàng:</label>
                                            <select id="inputShift" class="form-control">
                                                <option selected="">Chọn ca lấy hàng</option>
                                                <option>Ca lấy 14-12-2023(7h-12h)</option>
                                                <option>Ca lấy 14-12-2023(12h-18h)</option>
                                                <option>Ca lấy 15-12-2023(7h-12h)</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="senderPhone">Số điện thoại:</label>
                                            <input name="" type="text" class="form-control" id="from_phone" placeholder="" value="0888888888">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center m-b-10">
                                        <h5>Thông tin người nhận</h5>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="receiverName">Tên người nhận:</label>
                                            <input name="" type="text" class="form-control" id="to_name" placeholder="" value="Cong Quyen">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="receiverPhone">Số điện thoại:</label>
                                            <input name="" type="text" class="form-control" id="to_phone" placeholder="" value="0888666888">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Tỉnh/Thành Phố</label>
                                            <select name="warehouse_pro" class="form-control" id="provinceSelect" >
                                                <option value="90816">Hồ Chí Minh
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Quận/Huyện</label>
                                            <select name="warehouse_dis" class="form-control" id="districtSelect">
                                                <option value="90816"> Quận 10
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Phường/Thị Xã</label>
                                            <select name="warehouse_ward" class="form-control" id="wardSelect">
                                                <option value="90816">Phường 14
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Chi tiết</label>
                                            <input name="warehouse_detail" class="form-control" id="addressDetail" type="text" value="72 Thành Thái">
                                        </div>
                                        <input hidden="" name="addressFull" class="form-control" id="addressFull">
                                    </div>
                                </form>


                                <hr>
                                <div class="d-flex justify-content-between align-items-center m-b-10">
                                    <h5>Thông tin đơn hàng</h5>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Mã đơn khách hàng</label>
                                        <input name="" type="text" class="form-control" id="client_order_code" placeholder="Nhập mã đơn" value="${id}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Tiền thu hộ (COD):</label>
                                        <input name="" type="text" class="form-control" id="cod_amount" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Tổng giá trị đơn (đền bù):</label>
                                        <input name="" type="text" class="form-control" id="insurance_value" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Gói dịch vụ:</label>
                                        <select id="inputState" class="form-control">
                                            <option selected="">Hàng nhẹ (&lt;20kg) </option>
                                            <option>Hàng nặng (&gt;20kg) </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="payment_type_id">Trả phí:</label>
                                        <select id="payment_type_id" class="form-control">
                                            <option value="1">Bên gửi trả phí</option>
                                            <option value="2">Bên nhận trả phí</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-2" id="partner-ticket">
                        <div class="card">
                            <div class="card-body">
                                <label for="inputEmail4">Phí dịch vụ:</label>
                                <div class="service-fee text-bold">Chưa tính</div>
                                <hr>
                                <label for="inputEmail4">Tổng phí:</label>
                                <div class="total-fee text-bold">Chưa tính</div>
                                <hr>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Mã hỗ trợ:</label>
                                    <input name="" type="text" class="form-control" id="coupon" placeholder="Nhập mã hỗ trợ từ GHN" value="">
                                </div>
                                <hr>
                                <button id="create-order-ticket" type="button" class="btn btn-primary push-modal2" atr="Push2" data-toggle="modal" data-target="#exampleModalCenter">Xác nhận</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            `);
            
            //Xử lý sự kiện khi chọn đơn vị vận chuyển
            $('.shipping-partner').change(function() {
                var partner = $(this).val();
                if (partner == 3) {
                    $('#partner-ticket').html(`
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Đơn vị vận chuyển</label>
                                        <input type="text" class="form-control" id="other-partner-name" placeholder="Tên đơn vị">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Mã vận chuyển</label>
                                        <input type="text" class="form-control" id="other-partner-code" placeholder="Mã vận chuyển">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Phí dịch vụ</label>
                                        <input type="text" class="form-control" id="other-partner-fee" placeholder="Phí vận chuyển">
                                    </div>
                                </form>
                                <hr>
                                
                            </div>
                        </div>
                `);      
                }
            });

            //Order.address.fill();

            Api.Order.GetOrderDetail(id).done((response) => {
                var items_list_2 = response.order_items;
                console.log(items_list_2);

                response.payment_status == 1 ?  $('#cod_amount').val(0): $('#cod_amount').val(response.value);
               
                $('#insurance_value').val(5000000);
                $('#to_name').val(response.name);
                $('#to_phone').val(response.phone);
                Order.address.fill(response);

            });

        },
        showPackagPage: (id) => {
            $('#order_status_update').html(`
                <option value="1">Đã xác nhận</option>
                <option value="2">Đã hoàn thiện</option>
                <option value="3" selected>Chờ lấy hàng</option>
                <option value="4">Đang giao hàng</option>
                <option value="5">Đã giao hàng</option>
                <option value="6">Đã hủy</option>
            `);
            $('#order-detail-body').append(`
                <!-- Phiếu giao hàng -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">THÔNG TIN ĐÓNG GÓI</h4>
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
                                                    <th>Mã vận đơn</th>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Giá</th>
                                                    <th>Dự kiến lấy</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>37</td>
                                                    <td id="pk-shipping-code">LF7GNK</td>
                                                    <td>${id}</td>
                                                    <td id="pk-order-value">18000</td>
                                                    <td>Kip 2</td>
                                                    <td id="pk-order-note">Không giao hàng vào giờ hành chính từ t2-t6</td>
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
                                    <button style="white-space: nowrap;" class="btn btn-primary btn-tone m-l-5" id="print-order-btn" data-order-id="${id}">                                        
                                        <i class="anticon anticon-plus-circle m-r-5"></i>
                                        <span>In phiếu đóng gói</span>
                                    </button>  
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            `);
            Api.Order.GetOrderDetail(id).done((response) => {
                $('#pk-shipping-code').text(response.shipping_code);
                $('#pk-order-value').text(response.value);
                $('#pk-order-note').text(response.description);
            });
            $('#print-order-btn').click(function() {
                //get data-order-id
                var order_id = $(this).data('order-id');
                console.log(order_id);
                Api.Order.printTicket(order_id).done((response) => {
                    if (response.status) {
                        if (response.status = 500) {
                            alert('Đơn hàng liên kết đối tác vận chuyển ngoài !');
                        }
                    }
                    // Giả sử response chứa đường dẫn đến tệp in
                    var printUrl = response; // Thay đổi thành trường chính xác chứa URL
                
                    if (printUrl) {
                        var printWindow = window.open(printUrl, '_blank');
                        printWindow.onload = function() {
                            printWindow.print();
                        };
                    } else {
                        console.error('Không có liên kết để in.');
                    }
                });
                
            });

        },
        showPendingShippingPage: () => {
            $('#order_status_update').html(`
                <option value="1">Đã xác nhận</option>
                <option value="2">Đã hoàn thiện</option>
                <option value="3">Chờ lấy hàng</option>
                <option value="4" selected >Đang giao hàng</option>
                <option value="5">Đã giao hàng</option>
                
            `);
        },
        showShippingPage: (id) => {
/*             var order_logs = [];
            Api.Order.GetOrderDetail(id).done((response) => {
                order_logs = response.log;
                console.log(order_logs);
            }); */
            $('#order_status_update').html(`
                <option value="1">Đã xác nhận</option>
                <option value="2">Đã hoàn thiện</option>
                <option value="3">Chờ lấy hàng</option>
                <option value="4">Đang giao hàng</option>
                <option value="5" selected>Đã giao hàng</option>
               
                <option value="7">Hoàn trả</option>
            `);
/*             $('#order-detail-body').append(`
                <!-- Theo dõi đơn hàng -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">THEO DÕI ĐƠN HÀNG</h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th colspan="2">Người gửi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>Tên cửa hàng</td>
                                                    <td>BkPerfume</td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td>0866222888</td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ</td>
                                                    <td>66, Trương Định, Hai Bà Trưng, Hà Nội</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="card">
                                <div class="card-body ">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-info">
                                                <th colspan="2">Người nhận</th>
                                            </tr>
                                        </thead>
                                        <tbody class="data-list"> 
                                            <tr>
                                                <td>Tên khách hàng</td>
                                                <td>Nguyễn Công Quyền</td>
                                            </tr>
                                            <tr>
                                                <td>Số điện thoại</td>
                                                <td>0976222666</td>
                                            </tr>
                                            <tr>
                                                <td>Địa chỉ</td>
                                                <td>66, Nguyễn Trãi, Thanh Xuân, Hà Nội</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th colspan="2">Thông tin đơn hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>Khách phải trả</td>
                                                    <td>500,000₫</td>
                                                </tr>
                                                <tr>
                                                    <td>Phân loại</td>
                                                    <td>Cho thử hàng</td>
                                                </tr>
                                                <tr>
                                                    <td>Phí vận chuyển</td>
                                                    <td>Người gửi thanh toán</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
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
                                                <td>Mã vận chuyển</td>
                                                <td>JHGN7</td>
                                            </tr>
                                            <tr>
                                                <td>Mã đơn hàng</td>
                                                <td>104</td>
                                            </tr>
                                            <tr>
                                                <td>Dự kiến lấy</td>
                                                <td>10-10-2024</td>
                                            </tr>
                                            <tr>
                                                <td>Dự kiến giao</td>
                                                <td>12-10-2024</td>
                                            </tr>
                                            <tr>
                                                <td>Trạng thái hiện tại</td>
                                                <td>Chờ lấy hàng</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th colspan="3">Theo dõi đơn hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data-list">
                                                <tr>
                                                    <th>Trạng thái</th>
                                                    <th>Thời gian</th>
                                                    <th>Chi tiết</th>
                                                </tr> 
                                                <tr>
                                                    <td>Chờ lấy hàng</td>
                                                    <td>10-6-2024 8:27:22</td>
                                                    <td>167 Giải Phóng, Phương Mai, Đống Đa, Hà Nội, Vietnam</td>
                                                </tr>
                                                <tr>
                                                    <td>Đã lấy hàng</td>
                                                    <td>10-6-2024 15:22:22</td>
                                                    <td>Kho Giải Phóng, Phương Mai, Đống Đa, Hà Nội, Vietnam</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            `); */
            Api.Order.GetOrderDetail(id).done((response) => {
                var status_index = ['Chờ xử lý ', 'Đã xác nhận ', 'Đã hoàn thiện, ', 'Chờ lấy hàng ', 'Đang giao hàng ', 'Đã giao hàng ', 'Đã hủy '];
                const order_logs = response.log;
                console.log(order_logs);
            
                // Tạo bảng trạng thái
                let trackingRows = '';
                order_logs.forEach(log => {
                    const [timestamp, status] = log.split(' - '); // Chia thời gian và trạng thái
                    trackingRows += `
                        <tr>
                            <td>${status}</td>
                            <td>${timestamp}</td>
                            <td>-</td>
                        </tr>
                    `;
                });
            
                $('#order-detail-body').append(`
                    <!-- Theo dõi đơn hàng -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">THEO DÕI ĐƠN HÀNG</h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="2">Người gửi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list"> 
                                                    <tr>
                                                        <td>Tên cửa hàng</td>
                                                        <td>BkPerfume</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Số điện thoại</td>
                                                        <td>0866222888</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Địa chỉ</td>
                                                        <td>66, Trương Định, Hai Bà Trưng, Hà Nội</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-body ">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th colspan="2">Người nhận</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data-list"> 
                                                <tr>
                                                    <td>Tên khách hàng</td>
                                                    <td>${response.name}</td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td>${response.phone}</td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ</td>
                                                    <td>${response.address.address}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="2">Thông tin đơn hàng</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list"> 
                                                    <tr>
                                                        <td>Khách phải trả</td>
                                                        <td>${response.value}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phân loại</td>
                                                        <td>Cho thử hàng</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phí vận chuyển</td>
                                                        <td>Người gửi thanh toán</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
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
                                                    <td>Mã vận chuyển</td>
                                                    <td>${response.shipping_code}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mã đơn hàng</td>
                                                    <td>${response.id}</td>
                                                </tr>
                                                <tr>
                                                    <td>Dự kiến lấy</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Dự kiến giao</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Trạng thái hiện tại</td>
                                                    <td>${status_index[response.status]}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-info">
                                                        <th colspan="3">Theo dõi đơn hàng</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="data-list">
                                                    <tr>
                                                        <th>Trạng thái</th>
                                                        <th>Thời gian</th>
                                                        <th>Chi tiết</th>
                                                    </tr> 
                                                    ${trackingRows} <!-- Chèn các dòng trạng thái ở đây -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
            
            
        }
    },
    update: {
        updateDefaultStatus: () => {
            $(document).off('click', '#save-order-btn');
            $(document).on('click', '#save-order-btn', function() {
                console.log('Button clicked 1!');

                //Lấy ra shipping-partner
                var shipping_partner = $('.shipping-partner').val();
                if (shipping_partner == 3) {
                    var other_partner_name = $('#other-partner-name').val();
                    var other_partner_code = $('#other-partner-code').val();
                    var other_partner_fee = $('#other-partner-fee').val();
                    
                    //check nếu trống thì alert
                    if (other_partner_name == '' || other_partner_code == '' || other_partner_fee == '') {
                        alert('Vui lòng nhập đầy đủ thông tin đơn vị vận chuyển khác');
                        return;
                    }
                }else{
                    other_partner_name = '';
                    other_partner_code = '';
                    other_partner_fee = '';
                }
                console.log('shipping_partner:', shipping_partner);
                console.log('other_partner_name:', other_partner_name);
                console.log('other_partner_code:', other_partner_code);
                console.log('other_partner_fee:', other_partner_fee);

                //lấy id order từ data-id của button save
                var id = $('#save-order-btn').attr('data-id');
                console.log('id order: ' + id);
                var data = {
                    status: $('#order_status_update').val(),
                    note: $('#order_note').val() || '',
                    shipping_partner: shipping_partner,
                    other_partner_name: other_partner_name,
                    other_partner_code: other_partner_code,
                    other_partner_fee: other_partner_fee
                };
                console.log(data);
                Api.Order.UpdateOrder(id, data).done((response) => {
                    console.log('Button clicked2 id:', id);

                    if (response.status == 200) {
                        $('.alert.alert-success').show();
                        setTimeout(() => {
                            $('.alert.alert-success').fadeOut(); // Sử dụng fadeOut để ẩn một cách mượt mà
                        }, 3000);
                    } else {
                        $('.alert.alert-danger').show();
                        setTimeout(() => {
                            $('.alert.alert-danger').fadeOut(); // Sử dụng fadeOut để ẩn một cách mượt mà
                        }, 3000);
                    }
                    $('.bd-example-modal-xl').modal('hide');

                    //Order.orderList.show();
                    
                }).fail((response) => {
                    $('.alert.alert-danger').show();
                    $('#error_detail').text(response.statusText);
                    setTimeout(() => {
                        $('.alert.alert-danger').fadeOut(); // Sử dụng fadeOut để ẩn một cách mượt mà
                    }, 3000);
                    $('.bd-example-modal-xl').modal('hide');
                });
            });
        },
        updatePendingStatus: () => {
            $(document).off('click', '#create-order-ticket');
            $(document).on('click', '#create-order-ticket', function() {
                var id = $(this).data('id');
                var data = {
                    status: $('#order_status_update').val(),
                    note: $('#order_note').val() || '',
                    shipping_partner: $('.shipping-partner').val(),

                    //Thông tin gói hàng
                    length: $('#length').val(),
                    width: $('#width').val(),
                    height: $('#Height').val(),
                    massOption: $('input[name="massOption"]:checked').val(),
                    mass: $('#weight').val(),
                    required_note: $('#required_note').val(),
                    note: $('#note').val(),

                    //Thông tin người gửi
                    warehouse: $('#inputWarehouse').val(),
                    shift: $('#inputShift').val(),
                    from_phone: $('#from_phone').val(),

                    //Thông tin người nhận
                    to_name: $('#to_name').val(),
                    to_phone: $('#to_phone').val(),

                    province: $('#provinceSelect').val(),
                    to_district: $('#districtSelect').val(),
                    to_ward_code: $('#wardSelect').val(),

                    to_province_name: $('#provinceSelect option:selected').text(),
                    to_district_name: $('#districtSelect option:selected').text(),
                    to_ward_name: $('#wardSelect option:selected').text(),
                    to_address : $('#addressDetail').val(),

                    addressDetail: $('#addressDetail').val(),

                    //Thông tin đơn hàng
                    client_order_code: $('#client_order_code').val(),
                    cod_amount: $('#cod_amount').val(),
                    insurance_value: $('#insurance_value').val(),
                    service: $('#inputState').val(),
                    payment_type_id: $('#payment_type_id').val(),
                };

                console.log(data);
                Api.Order.createTicket (id, data).done((response) => {
                    console.log(response);
                    var fee_info = response.data;
                    $('#fee-info').html(`
                        <div class="p-10" style="background-color: rgb(204 213 221 / 50%);">
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 text-bold">COD:</div>
                                <div id="COD_cf" class="col-sm-4 col-md-4 col-lg-4">${fee_info.cod_fee}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 text-bold">Trả phí:</div>
                                <div class="col-sm-4 col-md-4 col-lg-4">Bên gửi trả phí</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 text-bold">Tổng phí:</div>
                                <div class="col-sm-4 col-md-4 col-lg-4">${fee_info.total}đ</div>
                            </div>
                        </div>
                    `);
                    $('#sender-receiver-info').html(`
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3 text-bold">Người gửi:</div>
                            <div id="from_name_cf" class="col-sm-3 col-md-3 col-lg-3">BK Perfume</div>
                            <div id="from_phone_cf" class="col-sm-3 col-md-3 col-lg-3">${data.from_phone}</div>
                            <div id="from_address_cf" class="col-sm-3 col-md-3 col-lg-3">Kho - ${data.warehouse}</div>
                        </div>
                    
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3 text-bold">Người nhận:</div>
                            <div id="to_name_cf" class="col-sm-3 col-md-3 col-lg-3">${data.to_name}</div>
                            <div id="to_phone_cf" class="col-sm-3 col-md-3 col-lg-3">${data.to_phone}</div>
                            <div id="to_address_cf" class="col-sm-3 col-md-3 col-lg-3">${data.to_address}</div>
                        </div>
                    `)
                    //$('.bd-example-modal-xl').modal('hide');
                    $(document).off('click', '#submit-order-ticket');
                    $(document).on('click', '#submit-order-ticket', function() {
                        Api.Order.submitTicket (id, data).done((response) => {
                            if (response.code == 400) {
                                if (response.message == "Lỗi gọi API: corev2_tenant_order_create - Lỗi hệ thống - không lấy được thông tin kho"){
                                    alert('Tạo đơn thất bại: Lỗi hệ thống -  không lấy được thông tin kho gửi hàng - Đổi địa chỉ hoặc liên hệ GHN !');
                                }
                                else {
                                    alert('Tạo đơn thất bại: '+ response.code_message_value);
                                    return;
                                }

                            }
                            console.log(response);
                            // Hiển thị thông báo ngay lập tức
                            $('#submit-order-ticket').html(`
                                <i class="anticon anticon-check-circle"></i> Tạo đơn thành công
                            `)

                            // Ẩn modal sau 3 giây
                            setTimeout(() => {
                                $('#submit-order-ticket').html(`
                                    Tạo đơn
                                `)
                                $('#exampleModalCenter').modal('hide');
                            }, 3000);
                        }).fail((response) => {
                            alert('Tạo đơn thất bại', response);
                        });
                    });



                });


            });
        },
    },
    address: {
        fill_main: () => {
            Api.User.checkAuth().done(function(data) {
                console.log(data);
                if (data.status === 'success') {
                    data = data.user_infor;
                    $('#name').val(data.name);
                    $('#phone').val(data.phone);
                    $('#detail_address').val(data.address.detailAddress);
    
                    // Clear existing options in province before filling
                    $('#provinceSelect').empty();
    
                    // Assuming getProvince() returns a promise
                    Api.Address.getProvince().done(function(provinces) {
                        if (provinces && Array.isArray(provinces.data)) {
                            provinces.data.forEach(element => {
                                $('#provinceSelect').append(`<option value="${element.ProvinceID}">${element.ProvinceName}</option>`);
                            });
    
                            // Trigger Chosen update
                            $('#provinceSelect').trigger("chosen:updated");
    
                            // Set the province after populating options
                            $('#provinceSelect').val(data.address.provinceId).trigger("chosen:updated");
    
                            // Load districts based on the selected province
                           Order.address.loadDistricts(data.address.provinceId, data.address.districtId);
    
                            // Set the ward based on the user's data
                           Order.address.loadWards(data.address.districtId, data.address.wardCode);
                        }
                    });
    
                    // Event listener for province change
                    $('#provinceSelect').on('change', function() {
                        var provinceId = $(this).val();
                       Order.address.loadDistricts(provinceId); // Load districts for the selected province
                    });
                } else {
                    Api.Address.getProvince().done(function(provinces) {
                        if (provinces && Array.isArray(provinces.data)) {
                            provinces.data.forEach(element => {
                                $('#provinceSelect').append(`<option value="${element.ProvinceID}">${element.ProvinceName}</option>`);
                            });
                            // Trigger Chosen update
                            $('#provinceSelect').trigger("chosen:updated");
                        }
                    });
                    $('#provinceSelect').on('change', function() {
                        var provinceId = $(this).val();
                       Order.address.loadDistricts(provinceId); // Load districts for the selected province
                    });
                }
            });
        },
        fill: (data) => {
                console.log(data);
                if (1) {
                    data = data;
                    $('#name').val(data.name);
                    $('#phone').val(data.phone);
                    $('#addressDetail').val(data.address.address);
    
                    // Clear existing options in province before filling
                    $('#provinceSelect').empty();
    
                    // Assuming getProvince() returns a promise
                    Api.Address.getProvince().done(function(provinces) {
                        if (provinces && Array.isArray(provinces.data)) {
                            provinces.data.forEach(element => {
                                $('#provinceSelect').append(`<option value="${element.ProvinceID}">${element.ProvinceName}</option>`);
                            });
    
                            // Trigger Chosen update
                            $('#provinceSelect').trigger("chosen:updated");
    
                            // Set the province after populating options
                            $('#provinceSelect').val(data.address.province).trigger("chosen:updated");
    
                            // Load districts based on the selected province
                           Order.address.loadDistricts(data.address.province, data.address.district, data.address.ward);
    
                            // Set the ward based on the user's data
                           Order.address.loadWards(data.address.district, data.address.ward);
                           console.log('goi lan 1');
                        }
                    });
    
                    // Event listener for province change
                    $('#provinceSelect').on('change', function() {
                        var province = $(this).val();
                       Order.address.loadDistricts(province); // Load districts for the selected province
                    });
                } else {
                    Api.Address.getProvince().done(function(provinces) {
                        if (provinces && Array.isArray(provinces.data)) {
                            provinces.data.forEach(element => {
                                $('#provinceSelect').append(`<option value="${element.ProvinceID}">${element.ProvinceName}</option>`);
                            });
                            // Trigger Chosen update
                            $('#provinceSelect').trigger("chosen:updated");
                        }
                    });
                    $('#provinceSelect').on('change', function() {
                        var provinceId = $(this).val();
                       Order.address.loadDistricts(provinceId); // Load districts for the selected province
                    });
                }

        },
    
        loadDistricts: (provinceId, selectedDistrictId = null, selectedWardCode = null) => {
            Api.Address.getDistrict(provinceId).done(function(data) {
                console.log(data);
                $('#districtSelect').empty(); // Clear existing options
                if (data && Array.isArray(data.data)) {
                    data.data.forEach(element => {
                        $('#districtSelect').append(`<option value="${element.DistrictID}">${element.DistrictName}</option>`);
                    });
                    $('#districtSelect').trigger("chosen:updated");
    
                    // Set the selected district if provided
                    if (selectedDistrictId) {
                        $('#districtSelect').val(selectedDistrictId).trigger("chosen:updated");
                        Order.address.loadWards(selectedDistrictId, selectedWardCode); // Load wards based on the selected district
                    }
    
                    // Event listener for district change
                    $('#districtSelect').on('change', function() {
                        var districtId = $(this).val();
                        Order.address.loadWards(districtId); // Load wards for the selected district
                    });
                }
            });
        },
    
        loadWards: (districtId, selectedWardCode = null) => {
            console.log('ton tai'+ selectedWardCode);
            Api.Address.getWard(districtId).done(function(data) {
                console.log(data);
                $('#wardSelect').empty(); // Clear existing options
                if (data && Array.isArray(data.data)) {
                    data.data.forEach(element => {
                        $('#wardSelect').append(`<option value="${element.WardCode}">${element.WardName}</option>`);
                    });
                    $('#wardSelect').trigger("chosen:updated");
    
                    // Set the selected ward if provided
                    if (selectedWardCode) {
                        
                        $('#wardSelect').val(selectedWardCode).trigger("chosen:updated");

                        //set selected cho ward cos value = selectedWardCode

                    }

                }
            });
        }
    },
    report: {
        export: () => {
            function downloadExcel(filename, data) {
              // Hàm giúp chuyển đổi địa chỉ từ chuỗi JSON sang dạng dễ đọc
              function formatAddress(addressJson) {
                try {
                  const address = JSON.parse(addressJson);
                  const detailAddress = address.address ? `${address.address}` : '';
                  // Chuyển dấu / thành dấu , để dễ đọc
                  const addressStr = JSON.stringify(detailAddress).replace(/\//g, ',');
                  
                  // Trả về địa chỉ theo định dạng dễ đọc
                  return addressStr;
                } catch (error) {
                  return "Địa chỉ không hợp lệ";
                }
              }
          
              // Chuyển đổi dữ liệu status và payment_status sang dạng chữ, bỏ cột Log
              const transformedData = data.map(order => [
                order.id,
                order.name,
                order.phone,
                //formatAddress(order.address), // Chuyển đổi địa chỉ thành dạng dễ đọc
                order.order_date,
                order.payment_method,
                order.payment_status === 0 ? 'Chưa thanh toán' : 'Đã thanh toán', // Chuyển payment_status sang chữ
                order.delivery_company_code,
                order.shipping_code,
                order.value,
                order.shipping_cost,
                (function() {
                    switch (order.status) {
                      case 0: return 'Chờ xử lý';
                      case 1: return 'Đã xác nhận';
                      case 2: return 'Đã hoàn thiện';
                      case 3: return 'Chờ lấy hàng';
                      case 4: return 'Đang giao hàng';
                      case 5: return 'Đã giao hàng';
                      case 6: return 'Hủy đơn';
                      default: return 'Không xác định';
                    }
                  })()
              ]);
          
              // Thêm tiêu đề cho bảng
              const headers = [
                "ID", "Tên", "Điện thoại", "Ngày đặt hàng", "Phương thức thanh toán", "Trạng thái thanh toán",
                "Mã công ty vận chuyển", "Mã giao hàng","Giá trị đơn", "Phí vận chuyển", "Trạng thái đơn hàng"
              ];
          
              // Tạo sheet từ dữ liệu
              const ws = XLSX.utils.aoa_to_sheet([headers, ...transformedData]);
          
              // Tính toán chiều rộng tối ưu cho mỗi cột, nhưng cố định cột Địa chỉ
              const colWidths = headers.map((header, index) => {
                let maxWidth = header.length; // Chiều rộng cột ban đầu là chiều dài tiêu đề
          
                // Để Địa chỉ không kéo dài quá mức, chúng ta sẽ xử lý riêng
                if (header === "Địa chỉ") {
                  maxWidth = Math.min(maxWidth, 50); // Cố định chiều rộng cột Địa chỉ (max 50 ký tự)
                } else {
                  // Với các cột khác, tính chiều rộng tối đa dựa trên giá trị trong cột
                  transformedData.forEach(row => {
                    const cellValue = row[index] ? row[index].toString() : '';
                    if (cellValue.length > maxWidth) {
                      maxWidth = cellValue.length;
                    }
                  });
                }
          
                return { wch: maxWidth + 2 }; // Thêm 2 ký tự để cột không bị cắt
              });
          
              // Áp dụng chiều rộng cột cho sheet
              ws['!cols'] = colWidths;
          
              // Tạo workbook mới
              const wb = XLSX.utils.book_new();
              XLSX.utils.book_append_sheet(wb, ws, "Đơn hàng");
          
              // Tạo file Excel và tải về
              XLSX.writeFile(wb, filename);
            }
      
            // Hàm để gọi API và lấy dữ liệu
            async function fetchDataAndDownload() {
              try {
                // Gọi API với phương thức GET
                const response = await fetch('http://127.0.0.1:8000/admin/order/all?order_status=4');
                
                if (!response.ok) {
                  throw new Error('Lỗi khi tải dữ liệu từ API');
                }
      
                // Chuyển đổi dữ liệu nhận về từ JSON
                const data = await response.json();
      
                // Gọi hàm downloadExcel để xuất file
                downloadExcel("danh_sach_don_hang.xlsx", data);
              } catch (error) {
                console.error("Lỗi khi tải dữ liệu:", error);
              }
            }
            // Gọi hàm fetchDataAndDownload khi trang được tải
            

            $('#export-excel').on('click', function() {
                var selectedElement = document.querySelector('.status-event.is-select');
                // Lấy giá trị của thuộc tính data-id
                var dataId = selectedElement ? selectedElement.getAttribute('data-id') : 0;
                var timeframe = $('#month-select').val();
                console.log(timeframe);
                Api.Order.GetOrdersList(dataId,timeframe).done((response) => {
                    console.log(response);

                    const timestamp = Date.now();
                    var file_name = 'ds-don-'+timestamp+'.xlsx';

                    downloadExcel(file_name, response);
                }).fail((response) => {
                    alert('Có lỗi xảy ra');
                    console.log(response);
                });
            });
        }
    } 
}

Order.orderList.show(); // Output: Order List => khoong theo moth
//Order.orderList.showByMonth(); // Output: Order List => theo moth
Order.orderList.viewDetail(); // Output: View Order Detail

Order.report.export(); // Output: Export Excel



//Order.template.showDefault(); // Output: Order Detail
/* Order.template.showPendingPage(); // Output: Pending Page
Order.template.showPackagPage(); // Output: Package Page
Order.template.showShippingPage(); // Output: Shipping Page */

