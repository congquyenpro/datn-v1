$(document).ready(function() {

    function formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    $total_price = 0;
    // Hàm để lấy giá trị mặc định
    function getDefaultValues() {
        $('.cart_item').each(function() {
            var $item = $(this);
            var productId = $item.data('id');
            var quantity = parseInt($item.find('.input-qty').val());
            var priceText = $item.find('.item-discount-price').text();
            var price = parseInt(priceText.replace(/,/g, '').replace('₫', '').trim());

            //set giá trị default
            $(this).find('.product-price .amount').html(formatPrice(quantity * price) + ' ₫');

            // $total_price += sub_total
            $total_price += quantity * price;
            var formattedPrice = formatPrice($total_price);


            // Cập nhật giá hiển thị
            $('#total-price').text(formattedPrice + ' ₫');

            console.log("ID sản phẩm: " + productId);
            console.log("Số lượng mặc định: " + quantity);
            console.log("Giá sản phẩm: " + price + " ₫");
        });
    }
    // Gọi hàm để lấy giá trị mặc định khi vào trang
    getDefaultValues();

    function updateCartItem($item) {
        // Lấy ID sản phẩm
        var productId = $item.data('id');

        // Lấy số lượng sản phẩm
        var quantity = parseInt($item.find('.input-qty').val());

        // Lấy giá sản phẩm
        var priceText = $item.find('.item-discount-price').text();
        var price = parseInt(priceText.replace(/,/g, '').replace('₫', '').trim());

        // Tính toán tổng giá
        var totalPrice = quantity * price;
        $item.find('.product-price .amount').html(formatPrice(totalPrice) + ' ₫');
        
        console.log("ID sản phẩm: " + productId);
        console.log("Số lượng sản phẩm: " + quantity);
        console.log("Giá sản phẩm: " + price + " ₫");
        console.log("Tổng giá: " + totalPrice + " ₫");

        //gọi lại hàm hiển thị tổng sản phẩm
        $total_price = 0;
        getDefaultValues();
    }

    // Gán sự kiện click cho nút tăng và giảm
    $('.btn-number').on('click', function(e) {
        e.preventDefault();
        var $input = $(this).siblings('.input-qty');
        var currentVal = parseInt($input.val());

        if ($(this).hasClass('qtyplus')) {
            $input.val(currentVal + 1);
        } else if (currentVal > 0) {
            $input.val(currentVal - 1);
        }

        // Cập nhật thông tin sản phẩm
        updateCartItem($(this).closest('.cart_item'));
    });

    // Gán sự kiện change cho ô nhập liệu số lượng
    $('.input-qty').on('change', function() {
        var $item = $(this).closest('.cart_item');
        updateCartItem($item);
    });

    $('.btn-number').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Ngăn sự kiện tiếp tục
    
        var $input = $(this).siblings('.input-qty');
        var currentVal = parseInt($input.val());
    
        if ($(this).hasClass('qtyplus')) {
            $input.val(currentVal + 1);
        } else if (currentVal > 0) {
            $input.val(currentVal - 1);
        }
    
        updateCartItem($(this).closest('.cart_item'));
    });
    
});
