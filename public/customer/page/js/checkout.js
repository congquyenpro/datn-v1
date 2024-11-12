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
                var provinceName = $('#province option:selected').text(); 
                var districtName = $('#district option:selected').text();
                var wardName = $('#ward option:selected').text();
                var fullAddress = $('#detail_address').val() + '/ ' + wardName + '/ ' + districtName + '/ ' + provinceName;

                var data = {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    province: $('#province').val(),
                    district: $('#district').val(),
                    ward: $('#ward').val(),
                    //detail_address: $('#detail_address').val(),
                    detail_address: fullAddress,
                    note: $('#note').val(),
                    payment_method: $('#payment_method').val(),
                    order_items: order_items
                };
                console.log(data);


                Api.Order.createOrder(data).done(function(data) {
                    console.log(data);
                    console.log(data.status);
                    if (data.status == '200') {
                        var payment_method = $('#payment_method').val();
                        if (payment_method == 'Online') {
                            //localStorage.removeItem('cart');
                            window.location.href = '/payment?order_code=OD' + data.data;
                        }
                        else {
                            var order_id = data.data;
                            localStorage.removeItem('cart');
                            window.location.href = '/order-success?id=OD' + order_id;
                        }

                    } else {
                        alert('Đặt hàng thất bại');
                    }

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                });
            });
        }
    },

    Cart: {
        init: function () {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            this.cartCount = cart.length;
            $('#cart-count').text(this.cartCount);
            $('#cart-count-2').text(this.cartCount);
    
            $(document).on('click', '.single_add_to_cart_button', (event) => {
                event.preventDefault();
                const button = $(event.target);
                const productCard = button.closest('.product-item');
                const productId = productCard.data('id');
                const productSizeId = productCard.data('id-size');
                const sizeValue = productCard.data('size');
    
                // Extract image, name, and price
                const productImage = productCard.find('img').attr('src');
                const productName = productCard.find('.product-name a').text();

                const productPrice = productCard.find('.price ins').text().replace('$', ''); // Remove dollar sign
    
                this.updateCart(productId,productSizeId, sizeValue, productImage, productPrice, productName);
                this.showCart();
                alert('Product added to cart!');
            });
            $(document).on('click', '.product-remove', (event) => {
                const button = $(event.target);
                const productId = button.closest('.product-remove').data('id');
                this.deleteProduct(productId);
                this.showCart();
            });
        },
        showCart: function (){
            let total = 0;
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartContent = document.getElementById('cart-content');
            cartContent.innerHTML = '';
            cart.forEach(product => {
                total += product.price * product.quantity;
                cartContent.innerHTML += `
                    <li class="product-cart mini_cart_item">
                        <a href="#" class="product-media">
                            <img src="${product.image}" alt="img">
                        </a>
                        <div class="product-details">
                            <h5 class="product-name">
                                <a href="#">${product.name}</a>
                            </h5>
                            <div class="variations">
                                <span class="attribute_size">
                                            <a href="#">${product.size}ml</a>
                                        </span>
                            </div>
                            <span class="product-price">
                                        <span class="price">
                                            <span>${product.price}</span>
                                        </span>
                                    </span>
                            <span class="product-quantity">
                                        (x${product.quantity})
                                    </span>
                            <div class="product-remove" data-id="${product.id}">
                                <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </li>
                `;
            });
            $('.total-price .Price-amount').text(total + ' ₫');
        },
        updateCart: function (productId,productSizeId, sizeValue, productImage, productPrice, productName) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
            let existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                const product = {
                    id: productId,
                    size_id : productSizeId,
                    size: sizeValue,
                    image: productImage,
                    price: parseFloat(productPrice), // Ensure price is a number
                    name: productName, // Include product name
                    quantity: 1
                };
                cart.push(product);
                this.cartCount++;
            }
    
            $('#cart-count').text(this.cartCount);
            $('#cart-count-2').text(this.cartCount);
            localStorage.setItem('cart', JSON.stringify(cart));
        },
        deleteProduct: function (productId) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartCount = cart.length;
            let existingProduct = cart.find(item => item.id === productId);

            if (existingProduct) {
                cart = cart.filter(item => item.id !== productId);
                cartCount--;
                $('#cart-count').text(this.cartCount);
                $('#cart-count-2').text(this.cartCount);
                localStorage.setItem('cart', JSON.stringify(cart));

                $('#cart-count').text(cartCount);
                $('#cart-count-2').text(cartCount);

                this.showCart();
            }
        }

    },
    
}

$(document).ready(function() {

   // Checkout.getAddresses.getSelectedAddress();
    Checkout.formSubmit.submit();
    Checkout.listItems.getItems();
    Checkout.getAddresses.fill();
});

Checkout.Cart.init();

Checkout.Cart.showCart();