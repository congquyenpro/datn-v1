document.addEventListener("DOMContentLoaded", function () {

    // Hàm cập nhật giỏ hàng
    function updateCart() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const totalPriceElement = document.getElementById('total-price');
        const listItemsElement = document.getElementById('list-items');

        // Hàm tính toán tổng giá giỏ hàng
        function calculateTotal() {
            let total = 0;
            cart.forEach(item => {
                total += item.price * item.quantity;
            });
            totalPriceElement.textContent = total.toLocaleString() + ' ₫';
            console.log('Total price:', total);
        }

        // Hàm render lại giỏ hàng
        function renderCart() {
            listItemsElement.innerHTML = ''; // Xóa các sản phẩm cũ

            cart.forEach(item => {
                const row = document.createElement('tr');
                row.classList.add('cart_item');
                row.setAttribute('data-id', item.id);
                row.setAttribute('data-id-size', item.size_id);
                row.setAttribute('data-size', item.size);

                row.innerHTML = `
                    <td class="product-remove">
                        <a href="#" class="remove" data-id="${item.id}" data-id-size="${item.size_id}" data-size="${item.size}"></a>
                    </td>
                    <td class="product-thumbnail">
                        <a href="#">
                            <img src="${item.image}" alt="img" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                        </a>
                    </td>
                    <td class="product-name" data-title="Product">
                        <a href="#" class="title">${item.name}</a>
                        <div class="item-price" style="font-size:14px">
                            <span class="item-o-price" style="text-decoration: line-through;">${item.price.toLocaleString()} ₫</span>
                            <span class="item-discount-price" style="font-weight: 500;">${item.price.toLocaleString()} ₫</span>
                        </div>
                    </td>
                    <td class="product-quantity" data-title="Quantity">
                        <div class="quantity">
                            <div class="control">
                                <a class="btn-number qtyminus quantity-minus" href="#" data-id="${item.id}" data-id-size="${item.size_id}" data-size="${item.size}">-</a>
                                <input type="text" data-step="1" data-min="0" value="${item.quantity}" title="Qty" class="input-qty qty" size="4">
                                <a href="#" class="btn-number qtyplus quantity-plus" data-id="${item.id}" data-id-size="${item.size_id}" data-size="${item.size}">+</a>
                            </div>
                        </div>
                    </td>
                    <td class="product-price" data-title="Price">
                        <span class="woocommerce-Price-amount amount">
                            ${(item.price * item.quantity).toLocaleString()}
                            <span class="woocommerce-Price-currencySymbol">₫</span>
                        </span>
                    </td>
                `;
                listItemsElement.appendChild(row);
            });

            calculateTotal(); // Cập nhật tổng giá sau khi render lại giỏ hàng
        }

        // Khởi tạo giỏ hàng khi trang được tải
        renderCart();
    }

    // Hàm log số lượng sản phẩm
    function logQuantityChange(productId, productSizeId, sizeValue, action) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let product = cart.find(item => item.id === productId && item.size_id === productSizeId);

        if (product) {
            console.log(`Product ID: ${productId}, Size: ${sizeValue}ml, Quantity ${action}: ${product.quantity}`);
        } else {
            console.log(`Product ID: ${productId} not found in the cart.`);
        }
    }

    // Hàm cập nhật số lượng sản phẩm
    function updateProductQuantity(productId, productSizeId, sizeValue, quantityChange) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let existingProduct = cart.find(item => item.id === productId && item.size_id === productSizeId);

        if (existingProduct) {
            existingProduct.quantity += quantityChange;

            // Không cho phép số lượng nhỏ hơn 1
            if (existingProduct.quantity < 1) {
                existingProduct.quantity = 1;
            }

            localStorage.setItem('cart', JSON.stringify(cart));
        }
    }

    // Hàm xóa sản phẩm khỏi giỏ hàng
    function removeProductFromCart(productId, productSizeId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Tìm và loại bỏ sản phẩm khỏi giỏ hàng
        cart = cart.filter(item => item.id !== productId || item.size_id !== productSizeId);

        // Lưu lại giỏ hàng đã cập nhật
        localStorage.setItem('cart', JSON.stringify(cart));

        // Cập nhật lại giỏ hàng
        updateCart();
    }    

    // Sự kiện tăng số lượng sản phẩm
    $(document).on('click', '.quantity-plus', (event) => {
        event.preventDefault();

        const button = $(event.target);
        const productId = button.data('id');
        const productSizeId = button.data('id-size');
        const sizeValue = button.data('size');

        // Log thông tin trước khi cập nhật số lượng
        logQuantityChange(productId, productSizeId, sizeValue, 'increased');

        // Tiến hành tăng số lượng
        updateProductQuantity(productId, productSizeId, sizeValue, 1);
        
        // Cập nhật lại giỏ hàng sau khi thay đổi số lượng
        updateCart();  // Gọi lại updateCart để render lại giỏ hàng
    });

    // Sự kiện giảm số lượng sản phẩm
    $(document).on('click', '.quantity-minus', (event) => {
        event.preventDefault();

        const button = $(event.target);
        const productId = button.data('id');
        const productSizeId = button.data('id-size');
        const sizeValue = button.data('size');

        // Log thông tin trước khi cập nhật số lượng
        logQuantityChange(productId, productSizeId, sizeValue, 'decreased');

        // Tiến hành giảm số lượng
        updateProductQuantity(productId, productSizeId, sizeValue, -1);
        
        // Cập nhật lại giỏ hàng sau khi thay đổi số lượng
        updateCart();  // Gọi lại updateCart để render lại giỏ hàng
    });

    $(document).on('click', '.remove', (event) => {
        event.preventDefault();

        const button = $(event.target);
        const productId = button.data('id');
        const productSizeId = button.data('id-size');

        // Xóa sản phẩm khỏi giỏ hàng
        removeProductFromCart(productId, productSizeId);
    });

    // Gọi hàm cập nhật giỏ hàng khi trang được tải
    updateCart();
});
