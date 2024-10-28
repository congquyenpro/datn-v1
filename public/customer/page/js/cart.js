const HomePage = {
    Cart: {
        cartCount: 0, // Biến lưu số lượng sản phẩm trong giỏ hàng

        // Hàm khởi tạo giỏ hàng từ localStorage
        init: function () {
            // Lấy giỏ hàng từ localStorage, nếu không có thì khởi tạo mảng rỗng
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            this.cartCount = cart.length; // Cập nhật số lượng sản phẩm trong giỏ hàng

            // Cập nhật hiển thị số lượng sản phẩm trong giỏ hàng
            document.getElementById('cart-count').innerText = this.cartCount;

            // Thêm sự kiện lắng nghe cho các nút "Add to cart"
            document.querySelectorAll('.single_add_to_cart_button').forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault(); // Ngăn chặn hành động mặc định

                    // Lấy thông tin sản phẩm
                    const productCard = button.closest('.product-item');
                    const productImage = productCard.querySelector('img').src; // Lấy hình ảnh
                    const productPrice = productCard.querySelector('.price del').innerText; // Lấy giá
                    const productId = productCard.getAttribute('data-slick-index'); // Lấy ID của sản phẩm

                    this.updateCart(productId, productImage, productPrice); // Gọi hàm cập nhật giỏ hàng
                    alert('Product added to cart!'); // Hiển thị thông báo
                });
            });
        },

        // Hàm cập nhật giỏ hàng
        updateCart: function (productId, productImage, productPrice) {
            // Lấy giỏ hàng từ localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let existingProduct = cart.find(item => item.id === productId);
        
            if (existingProduct) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng
                existingProduct.quantity++;
            } else {
                // Nếu sản phẩm chưa có, thêm sản phẩm mới với quantity = 1
                const product = {
                    id: productId,
                    image: productImage,
                    price: productPrice,
                    quantity: 1
                };
                cart.push(product);
            }
        
            // Cập nhật số lượng giỏ hàng
            this.cartCount = cart.reduce((acc, item) => acc + item.quantity, 0);
            // Cập nhật DOM chỉ một lần
            document.getElementById('cart-count').innerText = this.cartCount;
        
            // Lưu lại giỏ hàng vào localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
        }
        
    }
};

/* // Khởi tạo giỏ hàng khi trang được load
document.addEventListener('DOMContentLoaded', function () {
    HomePage.Cart.init();
});
 */