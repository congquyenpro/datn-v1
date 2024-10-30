// api.js


// index.js
const Index = {
    DealOfDay: {
        show() {
            const productContainer = document.getElementById('deal_of_day');
            productContainer.innerHTML = ''; // Xóa nội dung cũ
            //trả về promise cho chờ lấy dữ liệu xong mới chạy countdown
            return Api.Product.GetDealOfDay().then((data) => {
                console.log(data);
                data.forEach(element => {
                    productContainer.innerHTML += `
                    <div class="product-item style-5" data-id="${element.product_id}"  data-id-size="${element.product_size_id}" data-size=${element.size}>
                    <div class="product-inner equal-element">
                        <div class="product-top">
                            <div class="flash">
                                <span class="onnew">
                                    <span class="text">new</span>
                                </span>
                            </div>
                        </div>
                        <div class="product-thumb">
                            <div class="thumb-inner">
                                <a href="/nuoc-hoa/${element.slug}">
                                    <img src="${element.image}" alt="${element.product_name}">
                                </a>
                                <div class="thumb-group">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div class="yith-wcwl-add-button">
                                            <a href="#">Add to Wishlist</a>
                                        </div>
                                    </div>
                                    <a href="#" class="button quick-wiew-button">Quick View</a>
                                    <div class="loop-form-add-to-cart">
                                        <button class="single_add_to_cart_button button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="product-count-down">
                                <div class="stelina-countdown is-countdown" data-time="${element.end_date}"><span class="box-count day"><span class="number">00</span> <span class="text">Days</span></span><span class="box-count hrs"><span class="number">00</span> <span class="text">Hrs</span></span><span class="box-count min"><span class="number">00</span> <span class="text">Mins</span></span><span class="box-count secs"><span class="number">00</span> <span class="text">Secs</span></span></div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-name product_title">
                                <a href="/nuoc-hoa/${element.slug}">${element.product_name}</a>
                            </h5>
                            <div class="group-info">
                                <div class="stars-rating">
                                    <div class="star-rating">
                                        <span class="star-${element.rate}"></span>
                                    </div>
                                    <div class="count-star">(3)</div>
                                </div>
                                <div class="price">
                                    <del>$${element.price + element.price*element.discount/100}</del>
                                    <ins>$${element.price}</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    `;
                });
                // Khởi tạo Slick sau khi thêm các sản phẩm
                $('.deal-of-day-items').slick({
                    dots: true,
                    infinite: true,
                    speed: 2000,
                    slidesToShow: 4,
                    slidesToScroll: 4, //Lỗi hiển thị x4 sản phẩm => /4 slide 1 lần chạy
                    autoplay: true,
                    autoplaySpeed: 2000,
                    arrows: false, //lỗi khi true
                    responsive: [
                        {
                            breakpoint: 1024, // Màn hình lớn hơn 1024px
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 768, // Màn hình từ 768px đến 1024px
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480, // Màn hình nhỏ hơn 768px
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                speed: 1000,
                            }
                        }
                    ]
                });
                $('.prev').on('click', function() {
                    $('.deal-of-day-items').slick('slickPrev');
                });
                
                $('.next').on('click', function() {
                    $('.deal-of-day-items').slick('slickNext');
                });
                
            });
        },
        countDown() {
            document.querySelectorAll('.stelina-countdown').forEach(element => {
                const timeData = element.getAttribute('data-time');
                const [date, time] = timeData.split(' '); // Tách ngày và giờ
                const [day, month, year] = date.split('/').map(Number); // Tách ngày, tháng, năm
                const [hours, minutes, seconds] = time.split(':').map(Number); // Tách giờ, phút, giây

                console.log(day, month, year, hours, minutes, seconds);
        
                // Tạo đối tượng Date
                const endDate = new Date(year, month - 1, day, hours, minutes, seconds);

        
                const countdown = setInterval(() => {
                    const now = new Date();
                    const distance = endDate - now;
        
                    if (distance < 0) {
                        clearInterval(countdown);
                        element.innerHTML = "Đã hết thời gian!";
                        return;
                    }
        
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hoursLeft = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutesLeft = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const secondsLeft = Math.floor((distance % (1000 * 60)) / 1000);
        
                    // Cập nhật giao diện
                    element.querySelector('.box-count.day .number').textContent = String(days).padStart(2, '0');
                    element.querySelector('.box-count.hrs .number').textContent = String(hoursLeft).padStart(2, '0');
                    element.querySelector('.box-count.min .number').textContent = String(minutesLeft).padStart(2, '0');
                    element.querySelector('.box-count.secs .number').textContent = String(secondsLeft).padStart(2, '0');
                }, 1000);
            });
        },
        
    },
    BestSeller : {
        show() {
            const product = document.getElementById('best-seller-products');
            product.innerHTML = '';
            Api.Product.GetBestSeller().then((data) =>{
                console.log(data);
                data.forEach(element => {
                    product.innerHTML += `
                    <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1" data-id-size="${element.product_size_id}" data-id="${element.product_id}" data-size="${element.size}">
                    <div class="product-inner equal-element">
                        <div class="product-top">
                            <div class="flash">
                                    <span class="onnew">
                                        <span class="text">
                                            hot
                                        </span>
                                    </span>
                            </div>
                        </div>
                        <div class="product-thumb">
                            <div class="thumb-inner">
                                <a href="nuoc-hoa/${element.slug}">
                                    <img src="${element.image}" alt="img">
                                </a>
                                <div class="thumb-group">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div class="yith-wcwl-add-button">
                                            <a href="#">Add to Wishlist</a>
                                        </div>
                                    </div>
                                    <a href="#" class="button quick-wiew-button">Quick View</a>
                                    <div class="loop-form-add-to-cart">
                                        <button class="single_add_to_cart_button button">Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-name product_title">
                                <a href="nuoc-hoa/${element.slug}">${element.product_name}</a>
                            </h5>
                            <div class="group-info">
                                <div class="stars-rating">
                                    <div class="star-rating">
                                        <span class="star-4"></span>
                                    </div>
                                    <div class="count-star">
                                        (3)
                                    </div>
                                </div>
                                <div class="price">
                                    <del>
                                        $${element.price + element.price*element.discount/100}
                                    </del>
                                    <ins>
                                        $${element.price}
                                    </ins>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                    `;
                })
            })
        },
    },
    NewArrival : {
        show() {
            const product = document.getElementById('new-arrival-product');
            product.innerHTML = '';
            Api.Product.GetNewArrival().then((data) =>{
                console.log(data);
                data.forEach(element => {
                    product.innerHTML += `
                    <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1" data-id-size="${element.product_size_id}" data-id="${element.product_id}" data-size="${element.size}">
                    <div class="product-inner equal-element">
                        <div class="product-top">
                            <div class="flash">
                                    <span class="onnew">
                                        <span class="text">
                                            new
                                        </span>
                                    </span>
                            </div>
                        </div>
                        <div class="product-thumb">
                            <div class="thumb-inner">
                                <a href="nuoc-hoa/${element.slug}">
                                    <img src="${element.image}" alt="img">
                                </a>
                                <div class="thumb-group">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div class="yith-wcwl-add-button">
                                            <a href="#">Add to Wishlist</a>
                                        </div>
                                    </div>
                                    <a href="#" class="button quick-wiew-button">Quick View</a>
                                    <div class="loop-form-add-to-cart">
                                        <button class="single_add_to_cart_button button">Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-name product_title">
                                <a href="nuoc-hoa/${element.slug}">${element.product_name}</a>
                            </h5>
                            <div class="group-info">
                                <div class="stars-rating">
                                    <div class="star-rating">
                                        <span class="star-4"></span>
                                    </div>
                                    <div class="count-star">
                                        (3)
                                    </div>
                                </div>
                                <div class="price">
                                    <del>
                                        $${element.price + element.price*element.discount/100}
                                    </del>
                                    <ins>
                                        $${element.price}
                                    </ins>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                    `;
                })
            })
        },
    },
    TopViewed : {
        show() {
            const product = document.getElementById('top-viewed-product');
            product.innerHTML = '';
            Api.Product.GetTopViewed().then((data) =>{
                console.log(data);
                data.forEach(element => {
                    product.innerHTML += `
                    <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1" data-id-size="${element.product_size_id}" data-id="${element.product_id}" data-size="${element.size}">
                    <div class="product-inner equal-element">
                        <div class="product-top">
                            <div class="flash">
                                    <span class="onnew">
                                        <span class="text">
                                            Trending
                                        </span>
                                    </span>
                            </div>
                        </div>
                        <div class="product-thumb">
                            <div class="thumb-inner">
                                <a href="#">
                                    <img src="https://placehold.co/300x300" alt="img">
                                </a>
                                <div class="thumb-group">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div class="yith-wcwl-add-button">
                                            <a href="#">Add to Wishlist</a>
                                        </div>
                                    </div>
                                    <a href="#" class="button quick-wiew-button">Quick View</a>
                                    <div class="loop-form-add-to-cart">
                                        <button class="single_add_to_cart_button button">Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h5 class="product-name product_title">
                                <a href="#">${element.product_name}</a>
                            </h5>
                            <div class="group-info">
                                <div class="stars-rating">
                                    <div class="star-rating">
                                        <span class="star-4"></span>
                                    </div>
                                    <div class="count-star">
                                        (3)
                                    </div>
                                </div>
                                <div class="price">
                                    <del>
                                        $${element.price + element.price*element.discount/100}
                                    </del>
                                    <ins>
                                        $${element.price}
                                    </ins>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                    `;
                })
            })
        },
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

// Gọi hàm show khi tài liệu đã sẵn sàng
$(document).ready(function() {
    Index.DealOfDay.show().then(() =>{
        Index.DealOfDay.countDown();
    });
    Index.BestSeller.show();
    Index.NewArrival.show();
    Index.TopViewed.show();
    Index.Cart.init();

    // Show cart content
    Index.Cart.showCart();
});