

const ProductDetail = {
    comments : {
        getCommnents : function() {
            const listComments = $('#list-comments');

            let pathname = window.location.pathname;

            // Tách các phần trong đường dẫn theo dấu '/'
            let pathParts = pathname.split('/');

            // Giả sử phần cần lấy luôn nằm ở cuối URL sau phần '/nuoc-hoa/'
            let productSlug = pathParts[pathParts.length - 1];

            Api.Comment.getComments(productSlug).done(function(data){
                listComments.html('');
                data.forEach(element => {
                    listComments.append(`
                    <div class="conment-container">
                    <a href="#" class="avatar">
                        <img src="/customer/page/images/user_avatar.jpeg" alt="img" style=" width: 60px; height: 60px; ">
                    </a>
                    <div class="comment-text">
                        <div class="stars-rating">
                            <div class="star-rating">
                                <span class="star-${element.rating}"></span>
                            </div>
                            <div class="count-star">
                                (1)
                            </div>
                        </div>
                        <p class="meta">
                            <strong class="author">${element.user['name']}</strong>
                            <span>-</span>
                            <span class="time">12/10/2024</span>
                        </p>
                        <div class="description">
                            <p>${element.content}</p>
                        </div>
                    </div>
                </div>
                    `);
                });
            });
        },
        comment: function() {
            $('.rating-star').off('click');
            $('.rating-star').on('click', function(e) {
                var rating = $(this).data('star-id');

                //Xóa css của tất cả star
                $('.rating-star').css('color', '#ccc');
                //Thêm css cho star được chọn
                $(this).css('color', '#ffb933'); // Thay đổi màu của star được click
                //Thêm class active cho star được chọn
                $('.rating-star').removeClass('active');
                $(this).addClass('active');
            });

            $('#submit-comment').off('click');
            $('#submit-comment').on('click', function(e) {
                e.preventDefault();
                var rating = $('.rating-star.active').data('star-id');
                var content = $('#comment-content').val();

                //Check nếu null
                if (rating == null || content == '') {
                    alert('Vui lòng nhập đủ thông tin');
                    return;
                }


                // Lấy URL hiện tại của trang
                const url = window.location.pathname;  // Lấy toàn bộ URL (chỉ lấy phần đường dẫn)

                // Tách chuỗi theo dấu "/"
                const parts = url.split('/');

                // Lấy phần cuối cùng trong mảng parts (phần bạn cần)
                const slug = parts[parts.length - 1];  // "versace-eros-edt"

                var data = {
                    commentable_type: 'product',
                    slug: slug,
                    rating: rating,
                    content: content,
                };
                Api.Comment.createComment(data).done(function(res){
                    if (res.status == 201){
                        alert('Cảm ơn bạn đã đánh giá sản phẩm !');
                        ProductDetail.comments.getCommnents();
                        //Xóa nội dung comment cũ
                        $('#comment-content').val('');
                    }
                });
            });

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

            this.selectSize();

            //add to cart 2
            $(document).on('click', '.single_add_to_cart_button2', (event) => {
                event.preventDefault();
            
                // Tìm phần tử cha gần nhất chứa thông tin sản phẩm
                var $parent = $(event.currentTarget).closest('.details-product'); // Thay '.product-container' bằng selector phù hợp với cấu trúc của bạn
            
                // Lấy kích thước bình được chọn và data-size-id
                var $selectedPotSize = $parent.find('.attribute_size:last .list-size a.active');
            
                var sizeValue = $selectedPotSize.text().replace('ml', '').trim();
                var productSizeId = $selectedPotSize.data('size-id');
                var productId = $parent.data('id');
                var productName = $parent.find('.product-title').text().trim();
                var productPrice = $parent.find('.details-infor .price').text().trim().replace('$', '');
                var productImage = $parent.find('.product-preview .thumbnails_carousel:first img').attr('src');
                
                
                // Lấy số lượng từ input
                var quantity = $parent.find('.quantity .input-qty').val();
                quantity = parseInt(quantity);

                this.updateCart(productId,productSizeId, sizeValue, productImage, productPrice, productName,quantity);
                this.showCart();
                alert('Product added to cart!');

                // Kiểm tra và hiển thị kết quả
                console.log("Kích thước bình được chọn: " + sizeValue);
                console.log("ID kích thước bình: " + productSizeId);
                console.log("ID sản phẩm: " + productId);
                console.log("Tên sản phẩm: " + productName);
                console.log("Giá sản phẩm: " + productPrice);
                console.log("Ảnh sản phẩm: " + productImage);
                console.log("Số lượng: " + quantity);

            });
            

            
            $(document).on('click', '.product-remove', (event) => {
                const button = $(event.target);
                const productSizeId = button.closest('.product-remove').data('size_id');
                this.deleteProduct(productSizeId);
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
                            <div class="product-remove" data-size_id="${product.size_id}">
                                <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </li>
                `;
            });
            $('.total-price .Price-amount').text(total + ' ₫');
        },
        updateCart: function (productId,productSizeId, sizeValue, productImage, productPrice, productName, quantity = 1) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            productPrice = productPrice.replace(/,/g, ''); 
    
            let existingProduct = cart.find(item => item.size_id === productSizeId);
            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                const product = {
                    id: productId,
                    size_id : productSizeId,
                    size: sizeValue,
                    image: productImage,
                    price: parseFloat(productPrice), // Ensure price is a number
                    name: productName, // Include product name
                    quantity: quantity
                };
                cart.push(product);
                this.cartCount++;
            }
    
            $('#cart-count').text(this.cartCount);
            $('#cart-count-2').text(this.cartCount);
            localStorage.setItem('cart', JSON.stringify(cart));
        },
        deleteProduct: function (productSizeId) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartCount = cart.length;
            let existingProduct = cart.find(item => item.size_id === productSizeId);

            if (existingProduct) {
                cart = cart.filter(item => item.size_id !== productSizeId);
                cartCount--;
                $('#cart-count').text(this.cartCount);
                $('#cart-count-2').text(this.cartCount);
                localStorage.setItem('cart', JSON.stringify(cart));

                $('#cart-count').text(cartCount);
                $('#cart-count-2').text(cartCount);

                this.showCart();
            }
        },
        selectSize : function() {
            //thêm class active vào size được chọn
            $('.selected_size a').on('click', function(e) {
                e.preventDefault();
                $('.selected_size a').removeClass('active');
                $(this).addClass('active');

                //Cập nhất giá
                var $selectedPotSize = $('.attribute_size:last .list-size a.active');
                var productSizeId = $selectedPotSize.data('size-price');
                $('.details-infor .price').text(ProductDetail.Cart.formatPrice(productSizeId)+'₫');
            });
        },
        formatPrice: function (price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //return price;
        },

    },
}


ProductDetail.comments.getCommnents();


$(document).ready(function() {

    ProductDetail.Cart.init();

    // Show cart content
    ProductDetail.Cart.showCart();
});

ProductDetail.comments.comment();

