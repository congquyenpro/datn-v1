OrderHistory = {
    orders: {
        show : () => {
            $(document).ready(function() {
                //default status id
                var statusId = 0;
                OrderHistory.orders.get(statusId);
                
                $('.nav-link').on('click', function() {
                    var statusId = $(this).data('status-id');
                    OrderHistory.orders.get(statusId);
                    
                });
            });
        },
        get: (statusId) => {
            Api.Order.getOrderHistory(statusId).done((data) => {
                console.log(data);
                
                // Tạo selector từ orderStatusId
                const orderStatusSelector = `#order-status-${statusId}`;
                var status_index = [
                    "Chờ xác nhận",
                    "Đã xác nhận",
                    "Chờ giao hàng",
                    "Đang giao hàng",
                    "Đã giao hàng",
                    "Đã hủy"
                ]
                
                // Làm sạch nội dung cũ trước khi thêm mới
                $(orderStatusSelector).empty();
        
                // Lặp qua từng phần tử trong data
                data.forEach(element => {
                    // Tạo một thẻ div cho mỗi đơn hàng
                    const orderItem = `
                        <div class="order-item">
                            <div class="item-content">
                                <div style="overflow: hidden; margin-top: 12px;">
                                    <div class="item-status" style="float: left; color:#ab8e66;">${status_index[element.status]} - OD${element.order_id}</div>
                                    <a  href="/order-detail?order_id=OD${element.order_id}" target="_blank" class="item-status" style="float: right; cursor: pointer;">Xem chi tiết</a>
                                </div>
                                <hr>
                                ${element.product_size_info.map(product => `
                                    <div class="row product-row" style=" margin-top: 5px; ">
                                        <div class="col-sm-3 product-image">
                                            <div class="mt-3" style="display: flex; justify-content: center;">
                                                <img src="${product.image}" class="rounded" alt="Product Image" width="50%" height="236"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6 product-details">
                                            <div class="row">
                                                <div class="col-sm-12 product-name">${product.product_name}</div>
                                                <div class="col-sm-12 product-quantity">${product.product_size_name} ml</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 product-price">${(product.product_size_price).toLocaleString()}₫</div>
                                    </div>
                                `).join('')}
                                <hr>
                                <div class="total">Total Price: ${element.product_size_info.reduce((total, product) => total + (product.product_size_price*product.quantity), 0).toLocaleString()}₫</div>
                            </div>
                        </div>
                    `;
        
                    // Thêm đơn hàng vào phần tử theo orderStatusId
                    $(orderStatusSelector).append(orderItem);
                });
            });
        }
        
        
            
    }
}

OrderHistory.orders.show();


