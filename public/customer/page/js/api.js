const Api = {
    Product: {},
    Atrributes: {},
    Cart: {},
    Address: {},
    User: {},
    Order: {},
    Comment: {},
    Other: {},
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
Api.Product.GetDealOfDay = () => $.ajax({
   /*  url: `http://127.0.0.1:3000/deal-of-day` */
    url: `/api-v1/promotion/deal-of-day`,
    method: 'GET',
});

Api.Product.GetBestSeller = () => $.ajax({
    /* url: `http://127.0.0.1:3000/best-seller`, */
    url: `/api-v1/product/type/best`,
    method: 'GET',
});

Api.Product.GetNewArrival = () => $.ajax({
    /* url: `http://127.0.0.1:3000/new-arrival` */
    url: `/api-v1/product/type/new`,
    method: 'GET',
});

Api.Product.GetTopViewed = () => $.ajax({
  /*   url: `http://127.0.0.1:3000/new-arrival`, */
    url: `/api-v1/product/type/top_view`,
    method: 'GET',
});

//Ví dụ tag=
Api.Product.GetValueByCriteria = (criteria,value) => $.ajax({
    url: `http://127.0.0.1:3000?${criteria}=${value}`,
    method: 'GET',
});



//Ví dụ; get all criteria of Tag (All,For Your Age,..), Brand(brd1, brd2, brd3), Gender(male, female, unisex),...
//response: {value,count}
Api.Product.GetValueByCriteria = (criteria_name) => $.ajax({
    url: `http://127.0.0.1:3000?criteria=${criteria_name}`,
    method: 'GET',
});

//get all attributes and values
Api.Atrributes.getAll = () => $.ajax({
    /* url: `http://127.0.0.1:3000/all-attributes`, */
    url: `/api-v1/attribute-value/all`,
    method: 'GET',
});

//get products from filter to paginate and order === version cũ
/* Api.Product.GetProducts = (filter) => $.ajax({
    //url: `http://127.0.0.1:3000/products?${filter}`, //?field=price&order=asc&brand=6&gender=3a&volume=6b
    url: `/test?${filter}`,
    method: 'GET',
}); */
//version mới 16/11/2024
Api.Product.GetProducts = (filter) => $.ajax({
    //url: `http://127.0.0.1:3000/products?${filter}`, //?field=price&order=asc&brand=6&gender=3a&volume=6b
    url: `/api-v1/product/shop?${filter}`,
    method: 'GET',
});


/* Cart */
/* Get product-infor to add to localstorage */
Api.Cart.getProduct = (product_list) => $.ajax({
    url: ``,
    method: 'POST',
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


/* Checkout */
Api.Order.createOrder = (data) => $.ajax({
    //url: `http://127.0.0.1:3000/orders`,
    url: `/api-v1/order`,
    method: 'POST',
    data: data,
});

Api.Order.getOrderHistory = (status) => $.ajax({
    url: `/profile/order/all?status=${status}`,
});



/* Comment */
Api.Comment.getComments = (slug,type=null) => $.ajax({
    //url: `http://127.0.0.1:3000/comments?slug=${slug}`,
    url: `/api-v1/comment/all/${slug}?type=${type}`,
    method: 'GET',
});

Api.Other.test = (slug) => $.ajax({
    url: `/api-v1/comment/test`,
    method: 'GET',
});


Api.Comment.createComment = (data) => $.ajax({
    url: `/api-v1/comment/add`,
    method: 'POST',
    data: data,
});

Api.Comment.deleteComment = (id) => $.ajax({
    url: `/api-v1/comment`,
    method: 'DELETE',
    data: {id},
});





