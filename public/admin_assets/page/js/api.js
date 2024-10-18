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
    url: `/admin/product/get-all`,
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



Api.Product.AddNewProduct = (formData) => $.ajax({
    url: '/admin/product',
    method: 'POST',
    data: formData,
    processData: false, // Đặt false để ngăn jQuery tự động chuyển đổi formData thành chuỗi query
    contentType: false, // Đặt false để jQuery không đặt header `Content-Type` (formData sẽ tự thêm header đúng)
});

/* Api.Product.AddNewProduct()
    .then(res => console.log(res))
    .catch(console.error); */

    