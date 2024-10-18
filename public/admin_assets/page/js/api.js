const Api = {
    Category: {},
    Product: {},
};
(() => {
    $.ajaxSetup({
        headers: { 
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
        },
        crossDomain: true
    });
})();




//Product
Api.Product.GetProductsList = () => $.ajax({
    url: `http://127.0.0.1:3000/products_list`,
    method: 'GET',
});
Api.Product.GetProductDetail = (id) => $.ajax({
    url: `http://127.0.0.1:3000/product_detail/${id}`,
    method: 'GET',
});

Api.Product.GetAllAttributesValue = () => $.ajax({
    url: `/admin/product/getAllAttributes`,
    method: 'GET',
});
Api.Product.GetAllCategories = () => $.ajax({
    url: `/admin/product/category/getAll`,
    method: 'GET',
});

Api.Product.AddNewProduct = (formData) => {
    return $.ajax({
        //url: 'http://127.0.0.1:3000/add-new-product',  // Thay bằng URL API của bạn
        url: '/admin/product',
        method: 'POST',
        data: formData,
        processData: false, // Đặt false để ngăn jQuery tự động chuyển đổi formData thành chuỗi query
        contentType: false, // Đặt false để jQuery không đặt header `Content-Type` (formData sẽ tự thêm header đúng)
    });
};

/* Api.Product.AddNewProduct = (formData) => {
    for (let pair of formData.entries()) {
        console.log(`${pair[0]}: ${pair[1]}`);
    }
} */