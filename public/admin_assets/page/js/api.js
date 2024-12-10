const Api = {
    Category: {},
    Product: {},
    Order: {},
    Address: {},
    User: {},
    Warehouse: {},
    Blog: {},
    Report: {},
    Promotion: {},
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

/* Add new value of product */
Api.Product.AddNewValue = (data) => $.ajax({
    url: `/admin/product/addNewValue`,
    method: 'POST',
    data: JSON.stringify(data),
    processData: false,
    contentType: 'application/json',
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




Api.Order.GetOrdersList = (order_status) => $.ajax({
    //url: `http://127.0.0.1:3000/orders_list`,
    url : `/admin/order/all?order_status=${order_status}`,
    method: 'GET',
});

Api.Order.GetOrderDetail = (id) => $.ajax({
    //url: `http://127.0.0.1:3000/order_detail?id=${id}`,
    url : `/admin/order/detail/${id}`,
    method: 'GET',
});

Api.Order.UpdateOrder = (id, data) => $.ajax({
    url: `/admin/order/update-order`,
    method: 'POST',
    data: { id, data },
});

//Count Order
Api.Order.CountOrder = () => $.ajax({
    url: `/admin/order/count-order`,
    method: 'GET',
});

/* Connect Shipping Partner */
Api.Order.createTicket = (id,data) => $.ajax({
    url: `/admin/order/create-ticket`,
    method: 'POST',
    data: { id, data },
});
Api.Order.submitTicket = (id,data) => $.ajax({
    url: `/admin/order/submit-ticket`,
    method: 'POST',
    data: { id, data },
});
Api.Order.printTicket = (id) => $.ajax({
    url: `/admin/order/print-order/${id}`,
    method: 'GET',
});



/* Address */
Api.Address.getProvince = () => $.ajax({
    url: `https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province`,
    method: 'GET',
    headers: {
        'token': 'a26e2748-971a-11ee-b1d4-92b443b7a897',
        'Content-Type': 'application/json',
    },
});

Api.Address.getDistrict = (provinceId) => $.ajax({
    url: `https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id=${provinceId}`,
    method: 'GET',
    headers: {
        'token': 'a26e2748-971a-11ee-b1d4-92b443b7a897',
        'Content-Type': 'application/json',
    },
});

Api.Address.getWard = (districtId) => $.ajax({
    url: `https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=${districtId}`,
    method: 'GET',
    headers: {
        'token': 'a26e2748-971a-11ee-b1d4-92b443b7a897',
        'Content-Type': 'application/json',
    },
});

/* User */
Api.User.checkAuth = () => $.ajax({
    //url: `http://127.0.0.1:3000/user_infor2`,
    url: `/api-v1/user/infor`,
    method: 'GET',
});


/* Warehouse */
Api.Warehouse.getAllProducts = () => $.ajax({
    url: `/admin/warehouse/all-products`,
    method: 'GET',
});

Api.Warehouse.getProductSizes = (product_id) => $.ajax({
    url: `/admin/warehouse/get-sizes?product_id=${product_id}`,
    method: 'GET',
});

Api.Warehouse.store = (data) => $.ajax({
    url: `/admin/warehouse/store`,
    //url: `/api/warehouse/store`,
    method: 'POST',
    data: data,
});

Api.Warehouse.getHistory = () => $.ajax({
    url: `/admin/warehouse/get-inventory-changes`,
    method: 'GET',
});

Api.Warehouse.getOneHistory = (ticketId) => $.ajax({
    url: `/admin/warehouse/get-inventory-change-details/${ticketId}`,
    method: 'GET',
});

Api.Warehouse.getHistoryDetail = (ticketId) => $.ajax({
    url: `/admin/warehouse/get-change-details/${ticketId}`,
    method: 'GET',
});



/* Blog */
Api.Blog.store = (data) => $.ajax({
    url: `/admin/blog/create`,
    method: 'POST',
    data: data,
    processData: false, // Không xử lý dữ liệu, để trình duyệt tự xử lý FormData
    contentType: false, // Không đặt Content-Type, để trình duyệt tự động
    
});
Api.Blog.update = (data) => $.ajax({
    url: `/admin/blog/update`,
    method: 'POST',
    data: data,
    processData: false, // Không xử lý dữ liệu, để trình duyệt tự xử lý FormData
    contentType: false, // Không đặt Content-Type, để trình duyệt tự động
});
Api.Blog.delete = (id) => $.ajax({
    url: `/admin/blog/delete/${id}`,
    method: 'GET',
});

/* Report */
Api.Report.getReport = (start_date,end_date) => $.ajax({
    //url: `http://127.0.0.1:3000/report?start_date=${start_date}&end_date=${end_date}`,
    url : `/admin/report/revenue?start_date=${start_date}&end_date=${end_date}`,
    method: 'GET',
});
Api.Report.getReportByMonth = (year) => $.ajax({
    //url: `http://127.0.0.1:3000/report-by-month?year=${year}`,
    url : `/admin/report/revenue-by-month?year=${year}`,
    method: 'GET',
});

Api.Report.getReportByDay = (year, month) => $.ajax({
    //url: `http://127.0.0.1:3000/report-by-day?year=${year}&month=${month}`,
    url : `/admin/report/revenue-by-day?year=${year}&month=${month}`,
    method: 'GET',
});
Api.Report.getInventory = () => $.ajax({
      url: `/admin/report/inventory`,
      method: 'GET',
  });

//Get best seller and top viewed product từ bên customer làm report
Api.Product.GetBestSeller = () => $.ajax({
    /* url: `http://127.0.0.1:3000/best-seller`, */
    url: `/api-v1/product/type/best`,
    method: 'GET',
});
Api.Product.GetTopViewed = () => $.ajax({
    /*   url: `http://127.0.0.1:3000/new-arrival`, */
      url: `/api-v1/product/type/top_view`,
      method: 'GET',
  });


  /* Promotions */
Api.Promotion.delete = (id) => $.ajax({
    url: `/admin/promotions/delete/${id}`,
    method: 'GET',
});