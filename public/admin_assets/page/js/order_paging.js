const Order = {
    orderList: {
        show: () => {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/order/all', // Đường dẫn đến API
                    method: 'GET',
                    dataSrc: (json) => {
                        // Định dạng dữ liệu trước khi đưa vào DataTable
                        return json.data.map(order => ({
                            id: order.id,
                            name: order.name,
                            order_price: order.value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }),
                            order_date: order.order_date,
                            status: order.payment_status,
                            action: `<button class="btn btn-icon btn-hover btn-sm btn-rounded" onclick="viewOrder(${order.id})"><i class="anticon anticon-eye"></i></button>`
                        }));
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'order_price' },
                    { data: 'order_date' },
                    { data: 'status' },
                    { data: 'action', orderable: false }
                ],
                autoWidth: false,
                responsive: true,
                destroy: true // Hủy bỏ DataTable cũ trước khi khởi tạo lại
            });
        }
    }
}

Order.orderList.show(); // Gọi hàm để hiển thị danh sách đơn hàng
