<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// error page
Route::get('/error', function () {return view('errors.access-denied');})->name('error.page');


//Test: phân quyền theo role
Route::group(['middleware' => ['auth:sanctum', 'role.web:admin']], function() {
    Route::get('admin2/check', function(Request $request) {
        return $request->user();
    });
});

//Test: phân quyền theo permission
Route::group(['middleware' => ['auth:sanctum', 'permission.web:edit_products']], function() {
    Route::get('/products/check', function(Request $request) {
        return $request->user();
    });
    Route::get('/products/view', function(Request $request) {
        return 'co quyen view';
    });

});


//Role & Permission
Route::prefix('role-permission')->group(function() {
    // Home page of "Manage Role & Permission"
    Route::get('/roles', 'Admin\RoleController@index')->middleware(['auth:sanctum', 'role.web:admin'])->name('roles.index');
    // Create new role name
    Route::post('/roles', 'Admin\RoleController@store')->middleware(['auth:sanctum'])->name('roles.store');
    // Assign permissions to role
    Route::post('/roles/assign/{roleId}', 'Admin\RoleController@assignPermissions')->middleware(['auth:sanctum'])->name('roles.assignPermissions');
    //update role name
    Route::get('/roles/{role}', 'Admin\RoleController@show')->middleware(['auth:sanctum']);
    Route::put('/roles/update', 'Admin\RoleController@update')->name('roles.update')->middleware(['auth:sanctum']);
    Route::post('/permissions', 'Admin\PermissionController@store')->middleware(['auth:sanctum'])->name('permissions.store');

    Route::delete('/roles', 'Admin\RoleController@deleteRole')->middleware(['auth:sanctum'])->name('roles.delete');
    Route::delete('/permissions', 'Admin\PermissionController@deletePermission')->middleware(['auth:sanctum'])->name('permissions.delete');


    // Home Page of "Manage users' roles"
    Route::get('/users/manage-roles', 'UserController@manageRoles')->middleware(['auth:sanctum'])->name('users.manageRoles');

    //Get roles of user
    Route::get('/users/{user}/roles', 'UserController@getRoles')->middleware(['auth:sanctum'])->name('users.getRoles');
    // Assign roles to users => lỗi
    Route::post('/users/{user}/assign-roles', 'UserController@assignRoles')->middleware(['auth:sanctum'])->name('users.assignRoles');
    // Delete roles from users => lỗi
    Route::post('/users/{user}/remove-roles', 'UserController@removeRoles')->middleware(['auth:sanctum'])->name('users.removeRoles');
});




//sử dụng middleware động để khi thêm role mới sẽ không bị ảnh hưởng như trường hợp sử dụng 'role.web:admin', vì gia sử thêm 1 route mới thì không thể sử dụng middleware tĩnh 'role.web:admin','role.web:edittor',...
//nếu hệ thống phân quyền không quá phức tạp hoặc không cho người dùng tự tạo role, chỉ dùng những role có sẵn thì có thể sử dụng 'role.web:admin', 'role.web:edittor',... => tức role tĩnh trong code
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/roles2', 'Admin\RoleController@index')->middleware('permission.web:user_permission')->name('roles.index');
    Route::get('/role-check-2', function(){return 'co quyen xem';})->middleware('permission.web:user_permission')->name('roles.index');
});




/* Admin */
Route::prefix('admin')->group(function() {

    /* Admin Auth */
    Route::get('/auth/login','Manager\AuthController@login')->name('manager.auth.login');
    Route::post('/auth/login','Manager\AuthController@postLogin')->name('manager.auth.postLogin');
    Route::get('/auth/logout','Manager\AuthController@logout')->name('manager.auth.logout');
    
    //admin.home
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.home']], function() {
        Route::get('/', 'Manager\HomeController@display')->name('manager.home.display');
        Route::get('/check', function(Request $request) {
            return $request->user();
        });
    });

    //admin.product
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.product']], function() {
        Route::get('/product', 'Manager\Product\ProductController@showProducts')->name('manager.product');
        Route::get('/product/get-all', 'Manager\Product\ProductController@getAllProducts')->name('manager.product.getAll');
        Route::get('/product/get/{id}', 'Manager\Product\ProductController@getProductDetail')->name('manager.product.show');

        Route::post('/product', 'Manager\Product\ProductController@store')->name('manager.product.add');
        Route::get('/product/delete/{id}', 'Manager\Product\ProductController@delete')->name('manager.product.delete');

        //update product
        Route::post('/product/update', 'Manager\Product\ProductController@update')->name('manager.product.update');

        //Get attribute-value
        Route::get('/product/getAllAttributes', 'Manager\Product\ProductController@getAllAttributes');
        
        Route::get('/product/category', 'Manager\Product\CategoryController@showCategories')->name('manager.category');
        Route::post('/product/category', 'Manager\Product\CategoryController@addCategory')->name('manager.category.add');
        Route::put('/product/category', 'Manager\Product\CategoryController@updateCategory')->name('manager.category.update');
        Route::delete('/product/category', 'Manager\Product\CategoryController@deleteCategory')->name('manager.category.delete');
        /* api get all category */
        Route::get('/product/category/getAll', 'Manager\Product\CategoryController@getAll')->name('manager.category.getAll');
        
    });

    //admin promotion
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.promotion']], function() {
        Route::prefix('promotions')->group(function() {
            Route::get('/', 'Manager\Product\PromotionController@showAll')->name('manager.promotion');
            Route::post('/store', 'Manager\Product\PromotionController@store')->name('manager.promotion.store');
            Route::get('/delete/{id}', 'Manager\Product\PromotionController@delete')->name('manager.promotion.delete');
        });
    });

    //admin order
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.order']], function() {
        Route::prefix('order')->group(function() {
            Route::get('/', 'Manager\Order\OrderController@index')->name('manager.order');
            Route::get('/all', 'Manager\Order\OrderController@getOrders')->name('manager.order.getAll');
            Route::get('/detail/{id}', 'Manager\Order\OrderController@getOrderDetail')->name('manager.order.detail');
            Route::get('/type/{id}', 'Manager\Order\OrderController@getType')->name('manager.order.getType');

            Route::post('/update-order', 'Manager\Order\OrderController@updateOrder')->name('manager.order.update');

            //Shipping connect
            Route::post('/create-ticket', 'Manager\Order\OrderController@createTicket')->name('manager.order.createTicket');
            Route::post('/submit-ticket', 'Manager\Order\OrderController@submitTicket')->name('manager.order.submitTicket');

            Route::get('/get-address', 'Manager\Order\OrderController@getAddress')->name('manager.order.getAddress');

            //print order
            Route::get('/print-order/{id}', 'Manager\Order\OrderController@printOrder')->name('manager.order.print');
        });
    });


});






//Customer
Route::prefix('/')->group(function() {
    /* Test */
    Route::get('/test', 'TestController@test');

    /* Route API */
    Route::prefix('api-v1')->group(function() {
        //get user info
        Route::get('/user/infor', 'Customer\DisplayController@getUserJson')->middleware(['customer']);

        /* product */
        Route::get('/product/type/{type}', 'Customer\ProductController@getProductByType');
        Route::get('/product/detail/{slug}', 'Customer\ProductController@getProductDetail');
        Route::get('/product/related/{product_id}', 'Customer\ProductController@getRelatedProduct');

        /* Attribute-Value */
        Route::get('/attribute-value/all', 'Customer\ProductController@getAllAttributes');

        /* Order */
        Route::post('/order', 'Customer\OrderController@createOrder');


        /* Promotion */
        Route::get('/promotion/deal-of-day', 'Manager\Product\PromotionController@getDealOfDay');
    });


    /* Login */
    Route::get('/login','Customer\AuthController@login')->name('customer.auth.login');
    Route::post('/login','Customer\AuthController@postLogin')->name('customer.auth.postLogin');
    Route::get('/logout','Customer\AuthController@logout')->name('customer.auth.logout');
    Route::get('/register','Customer\AuthController@register')->name('customer.auth.register');
    Route::post('/register','Customer\AuthController@postRegister')->name('customer.auth.postRegister');


    /* Home */
    Route::get('/','Customer\DisplayController@displayHome')->name('customer.home');
    Route::get('/nuoc-hoa/{slug}','Customer\DisplayController@displayProduct')->name('customer.product');

    /* Cart and Checkout */
    Route::get('/checkout','Customer\DisplayController@checkout')->name('customer.checkout');
    Route::get('/order-success','Customer\DisplayController@orderSuccess')->name('customer.order-success');
    Route::get('/order-detail','Customer\DisplayController@orderDetail')->name('customer.order-detail');

    /* Shop */
    Route::get('/shop','Customer\ProductController@shop')->name('customer.shop');


    /* User Profile */
    Route::get('/profile','Customer\DisplayController@userProfile')->name('customer.profile')->middleware(['customer']);
    Route::post('/profile','Customer\AuthController@updateUserProfile')->name('customer.profile.update')->middleware(['customer']);

    Route::get('/profile/security','Customer\DisplayController@userSecurity')->name('customer.profile.security')->middleware(['customer']);
    Route::post('/profile/security','Customer\AuthController@changePassword')->name('customer.profile.security.update')->middleware(['customer']);

    Route::get('/profile/order','Customer\DisplayController@userOrder')->name('customer.profile.order')->middleware(['customer']);
    Route::get('/profile/order/all','Customer\OrderController@getOrderByUser')->name('customer.profile.order.detail')->middleware(['customer']);

    Route::get('/profile/order-detail','Customer\DisplayController@userOrderDetail')->name('customer.profile.order-detail')->middleware(['customer']);
});


