const Checkout = {
    listItems: {
        getItems: () => {
            //get items from local storage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let total = 0;
            let orderDetail = $('#order-detail');
            orderDetail.html('');
            cart.forEach(product => {
                total += product.price * product.quantity;
                orderDetail.append(`
                    <li class="product-item-order">
                        <div class="product-thumb">
                            <a href="#">
                                <img src="${product.image}" alt="img">
                            </a>
                        </div>
                        <div class="product-order-inner">
                            <h5 class="product-name">
                                <a href="#">${product.name}</a>
                            </h5>
                            <span class="attributes-select attributes-size">${product.size}ml</span>
                            <div class="price">
                                ${Checkout.listItems.formatPrice(product.price)} ₫
                                <span class="count">(x${product.quantity})</span>
                            </div>
                        </div>
                    </li>
                `);
            });
            $('#total-price').text(Checkout.listItems.formatPrice(total));
        },
        formatPrice: (price) => {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '₫';
        }
    },
    getAddresses: {
        fill: () => {
            // Fill data to form
            Api.User.checkAuth().done(function(data) {
                console.log(data);
                if (data.status === 'success') {
                    data = data.user_infor;
                    $('#name').val(data.name);
                    $('#phone').val(data.phone);
                    $('#detail_address').val(data.address.detailAddress);
    
                    // Clear existing options in province before filling
                    $('#province').empty();
    
                    // Assuming getProvince() returns a promise
                    Api.Address.getProvince().done(function(provinces) {
                        if (provinces && Array.isArray(provinces.data)) {
                            provinces.data.forEach(element => {
                                $('#province').append(`<option value="${element.ProvinceID}">${element.ProvinceName}</option>`);
                            });
    
                            // Trigger Chosen update
                            $('#province').trigger("chosen:updated");
    
                            // Set the province after populating options
                            $('#province').val(data.address.provinceId).trigger("chosen:updated");
    
                            // Load districts based on the selected province
                            Checkout.getAddresses.loadDistricts(data.address.provinceId, data.address.districtId);
    
                            // Set the ward based on the user's data
                            Checkout.getAddresses.loadWards(data.address.districtId, data.address.wardCode);
                        }
                    });
    
                    // Event listener for province change
                    $('#province').on('change', function() {
                        var provinceId = $(this).val();
                        Checkout.getAddresses.loadDistricts(provinceId); // Load districts for the selected province
                    });
                } else {
                    Api.Address.getProvince().done(function(provinces) {
                        if (provinces && Array.isArray(provinces.data)) {
                            provinces.data.forEach(element => {
                                $('#province').append(`<option value="${element.ProvinceID}">${element.ProvinceName}</option>`);
                            });
                            // Trigger Chosen update
                            $('#province').trigger("chosen:updated");
                        }
                    });
                    $('#province').on('change', function() {
                        var provinceId = $(this).val();
                        Checkout.getAddresses.loadDistricts(provinceId); // Load districts for the selected province
                    });
                }
            });
        },
    
        loadDistricts: (provinceId, selectedDistrictId = null) => {
            Api.Address.getDistrict(provinceId).done(function(data) {
                console.log(data);
                $('#district').empty(); // Clear existing options
                if (data && Array.isArray(data.data)) {
                    data.data.forEach(element => {
                        $('#district').append(`<option value="${element.DistrictID}">${element.DistrictName}</option>`);
                    });
                    $('#district').trigger("chosen:updated");
    
                    // Set the selected district if provided
                    if (selectedDistrictId) {
                        $('#district').val(selectedDistrictId).trigger("chosen:updated");
                        Checkout.getAddresses.loadWards(selectedDistrictId); // Load wards based on the selected district
                    }
    
                    // Event listener for district change
                    $('#district').on('change', function() {
                        var districtId = $(this).val();
                        Checkout.getAddresses.loadWards(districtId); // Load wards for the selected district
                    });
                }
            });
        },
    
        loadWards: (districtId, selectedWardCode = null) => {
            Api.Address.getWard(districtId).done(function(data) {
                console.log(data);
                $('#ward').empty(); // Clear existing options
                if (data && Array.isArray(data.data)) {
                    data.data.forEach(element => {
                        $('#ward').append(`<option value="${element.WardCode}">${element.WardName}</option>`);
                    });
                    $('#ward').trigger("chosen:updated");
    
                    // Set the selected ward if provided
                    if (selectedWardCode) {
                        $('#ward').val(selectedWardCode).trigger("chosen:updated");
                    }
                }
            });
        }
    },
      
    formSubmit: {
        submit : () => {
            $('.button-payment').on('click', function() {

                const fields = [
                    { id: '#name', message: 'Vui lòng nhập tên' },
                    { id: '#phone', message: 'Vui lòng nhập số điện thoại' },
                    { id: '#province', message: 'Vui lòng chọn tỉnh thành' },
                    { id: '#district', message: 'Vui lòng chọn quận huyện' },
                    { id: '#ward', message: 'Vui lòng chọn phường xã' },
                    { id: '#detail_address', message: 'Vui lòng nhập địa chỉ chi tiết' },
                    { id: '#payment_method', message: 'Vui lòng chọn phương thức thanh toán' },
                ];
                
                for (const field of fields) {
                    if ($(field.id).val() == '') {
                        alert(field.message);
                        return;
                    }
                }
                var order_list = JSON.parse(localStorage.getItem('cart'));
                var order_items = [];
                order_list.forEach(item => {
                    order_items.push({
                        product_id: item.id,
                        product_size_id: item.size_id,
                        size: item.size,
                        quantity: item.quantity,
                    });
                });
                //console.log(order_items);

                //send user_id to be
                var data = {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    province: $('#province').val(),
                    district: $('#district').val(),
                    ward: $('#ward').val(),
                    detail_address: $('#detail_address').val(),
                    note: $('#note').val(),
                    payment_method: $('#payment_method').val(),
                    order_items: order_items
                };
                console.log(data);


                Api.Order.createOrder(data).done(function(data) {
                    console.log(data.status);
                    if (data.status == '200') {
                        var order_id = data.data;
                        //alert('Đặt hàng thành công');
                        localStorage.removeItem('cart');
                        window.location.href = '/order-success?id=OD' + order_id;
                    } else {
                        alert('Đặt hàng thất bại');
                    }

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                });
            });
        }
    },
    
}

$(document).ready(function() {

   // Checkout.getAddresses.getSelectedAddress();
    Checkout.formSubmit.submit();
    Checkout.listItems.getItems();
    Checkout.getAddresses.fill();
});