// api.js


// index.js
const Index = {
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

// Gọi hàm show khi tài liệu đã sẵn sàng
$(document).ready(function() {
    Index.Cart.init();

    // Show cart content
    Index.Cart.showCart();
});