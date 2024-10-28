const Order = {
    orderList: {
        show: () => {
            var init_status = 1202;
            Api.Order.GetOrdersList(init_status).done((response) => {
                console.log(response);
                var order_status = [
                    `<span class="badge m-b-5 mr-1 badge-warning badge-pill">Chờ xử lý</span>`,
                    '<span class="badge m-b-5 mr-1 badge-info badge-pill">Đã xác nhận</span>',
                    'Đang giao hàng',
                    'Đã giao hàng',
                    'Đã hủy',
                ];
                var payment_status = [
                    `<span class="badge m-b-5 mr-1 badge-warning badge-pill">Chưa thanh toán</span>`,
                    'Đã thanh toán',
                ];
                const formattedData = response.map(order => ({
                    id: order.id,
                    name: `
                        <p><i class="far fa-user m-r-10"></i>${order.name}</p>
                        <p><i class="far fa-address-book m-r-10"></i>TEST</p>
                        <p><i class="fas fa-phone-alt m-r-10"></i>${order.phone}</p>
                    `,
                    order_price: order.value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }), // Định dạng giá
                    order_date: order.order_date,
                    status: order_status[order.status] + payment_status[order.payment_status], // Hoặc bất kỳ thông tin trạng thái nào bạn muốn hiển thị
                    action: `
                    <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                        <i class="anticon anticon-eye"></i>
                    </button>
                    <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                        <i class="anticon anticon-delete"></i>
                    </button>
                    `
                }));
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
                    responsive: true
                });
            });
                      

            
            
        }
    },

    template: {
        showDefault: () => {
            
        },
        showPendingPage: () => {

        },
    }
}

Order.orderList.show(); // Output: Order List