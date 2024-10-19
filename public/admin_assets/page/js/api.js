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
    url: `/admin/product/get/${id}`,
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
Api.Product.EditProduct = (formData) => $.ajax({
    url: '/admin/product/update',
    method: 'POST',
    data: formData,
    processData: false, // Đặt false để ngăn jQuery tự động chuyển đổi formData thành chuỗi query
    contentType: false, // Đặt false để jQuery không đặt header `Content-Type` (formData sẽ tự thêm header đúng)
});


    