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

        //delete and soft delete
        Route::get('/product/delete/{id}', 'Manager\Product\ProductController@delete')->name('manager.product.delete');
        Route::get('/product/soft-delete/{id}', 'Manager\Product\ProductController@softDelete')->name('manager.product.softDelete');

        //update product
        Route::post('/product/update', 'Manager\Product\ProductController@update')->name('manager.product.update');

        //Get attribute-value
        Route::get('/product/getAllAttributes', 'Manager\Product\ProductController@getAllAttributes');
        //add new value
        Route::post('/product/addNewValue', 'Manager\Product\ProductController@addNewValue');
        
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

            //count order
            Route::get('/count-order', 'Manager\Order\OrderController@countOrders')->name('manager.order.count');

            //test trừ đi số sản phẩm
            Route::get('/minus/{id}', 'Manager\Order\OrderController@minusProductQuantity')->name('manager.order.minusProductQuantity');

            //Shipping connect
            Route::post('/create-ticket', 'Manager\Order\OrderController@createTicket')->name('manager.order.createTicket');
            Route::post('/submit-ticket', 'Manager\Order\OrderController@submitTicket')->name('manager.order.submitTicket');

            Route::get('/get-address', 'Manager\Order\OrderController@getAddress')->name('manager.order.getAddress');

            //print order
            Route::get('/print-order/{id}', 'Manager\Order\OrderController@printOrder')->name('manager.order.print');
        });
    });

    /* warehouse */
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.order']], function() {
        Route::prefix('warehouse')->group(function() {
            Route::get('/', 'Manager\Warehouse\WarehouseController@index')->name('manager.warehouse');
            Route::get('/all-products', 'Manager\Warehouse\WarehouseController@getAllProducts')->name('manager.warehouse.getAll');
            Route::get('/get-sizes', 'Manager\Warehouse\WarehouseController@getProductSizes')->name('manager.warehouse.detail');

            Route::get('inventory', 'Manager\Warehouse\WarehouseController@showInventory')->name('manager.warehouse.inventory');
            
            Route::post('/store', 'Manager\Warehouse\WarehouseController@store')->name('manager.warehouse.store');

            Route::get('/get-inventory-changes', 'Manager\Warehouse\WarehouseController@getInventoryChanges')->name('manager.warehouse.getInventoryChanges');
            Route::get('/get-inventory-change-details/{ticketId}', 'Manager\Warehouse\WarehouseController@getInventoryChangeDetails')->name('manager.warehouse.getInventoryChangeDetails');
            Route::get('/get-change-details/{ticketId}', 'Manager\Warehouse\WarehouseController@getChangeDetails')->name('manager.warehouse.getChangeDetails');
        });
    });

    /* Post and Comment */
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.order']], function() {
        Route::prefix('blog')->group(function() {
            Route::get('/', 'BlogController@showManagerBlog')->name('manager.blog');
            Route::get('/detail/{id}', 'BlogController@editBog')->name('manager.blog.edit');
            Route::post('/create', 'BlogController@createBlog')->name('manager.blog.create');
            Route::post('/update', 'BlogController@updateBlog')->name('manager.blog.update');
            Route::get('/delete/{id}', 'BlogController@deleteBlog')->name('manager.blog.delete');
        });
    });

    /* Report */
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.order']], function() {
        Route::prefix('report')->group(function() {
            Route::get('/transaction', 'Manager\Report\ReportController@showTransaction')->name('manager.report.transaction');
            Route::get('/fin', 'Manager\Report\ReportController@showFin')->name('manager.report.fin');
            Route::get('/sale', 'Manager\Report\ReportController@showSale')->name('manager.report.sale');

            Route::get('/revenue', 'Manager\Report\ReportController@getRevenue')->name('manager.report.revenue');
            Route::get('/revenue-by-month', 'Manager\Report\ReportController@getRevenueByMonth')->name('manager.report.revenue.month');
            Route::get('/revenue-by-day', 'Manager\Report\ReportController@getRevenueByDay')->name('manager.report.revenue.day');

            //Lấy doanh thu ngày hiện tại
            Route::get('/report-today', 'Manager\Report\ReportController@getReportToday')->name('manager.report.revenue.today');

            Route::get('/inventory', 'Manager\Report\ReportController@getInventory')->name('manager.report.inventory');
        });
    });

    //Quản lý người dùng
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.promotion']], function() {
        Route::prefix('system')->group(function() {
           Route::get('/users', 'Manager\System\UserController@index')->name('manager.users');
           Route::get('/user/{user_id}', 'Manager\System\UserController@getAdminUserDetail')->name('manager.users.detail');
           Route::post('/user/{user_id}', 'Manager\System\UserController@update')->name('manager.users.update');
           Route::post('/users', 'Manager\System\UserController@store')->name('manager.users.store');

            Route::post('/roles', 'Manager\System\UserController@addRole')->name('manager.roles');

            Route::get('/permission-by-role/{role_id}', 'Manager\System\UserController@getPermissionsByRoleDetail')->name('manager.roles.permission');
            Route::post('/update-role/{role_id}', 'Manager\System\UserController@updatePermissionsByRole')->name('manager.roles.update');
        });
    });

    //Quản lý khách hàng
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:manager.promotion']], function() {
        Route::prefix('system')->group(function() {
           Route::get('/customers', 'Manager\System\CustomerController@index')->name('manager.customer');
           Route::get('/customer/detail', 'Manager\System\CustomerController@getUserOrderDetail')->name('manager.customer.detail');
           Route::get('/customer/infor', 'Manager\System\CustomerController@getUserInfor')->name('manager.customer.infor');
           Route::post('/customer/status', 'Manager\System\CustomerController@setUserStatus')->name('manager.customer.status');
           Route::get('/customers/orders', 'Manager\System\CustomerController@getCustomerOrderList')->name('manager.customer.order');
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
        Route::get('/product/shop', 'Customer\ProductController@getShop');
        Route::get('/product/type/{type}', 'Customer\ProductController@getProductByType');
        Route::get('/product/detail/{slug}', 'Customer\ProductController@getProductDetail');
        Route::get('/product/related/{product_id}', 'Customer\ProductController@getRelatedProduct');
        //get similar products
        Route::get('/product/similar/{product_id}', 'Customer\ProductController@getSimilarProduct');

        Route::get('/product/collaborative-filtering', 'Customer\ProductController@getCollaborativeFiltering'); 


        /* Attribute-Value */
        Route::get('/attribute-value/all', 'Customer\ProductController@getAllAttributes');

        /* Order */
        Route::post('/order', 'Customer\OrderController@createOrder');


        /* Promotion */
        Route::get('/promotion/deal-of-day', 'Manager\Product\PromotionController@getDealOfDay');

        /* Comment Product */
        Route::get('/comment/all/{slug}', 'CommentController@getAllComments');
        Route::get('/comment/test', 'CommentController@test');
        Route::post('/comment/add', 'CommentController@addComment')->middleware(['customer']);
        Route::delete('/comment', 'CommentController@deleteComment')->middleware(['customer']);
    });


    /* Login */
    Route::get('/login','Customer\AuthController@login')->name('customer.auth.login');
    Route::post('/login','Customer\AuthController@postLogin')->name('customer.auth.postLogin');
    Route::get('/logout','Customer\AuthController@logout')->name('customer.auth.logout');
    Route::get('/register','Customer\AuthController@register')->name('customer.auth.register');
    Route::post('/register','Customer\AuthController@postRegister')->name('customer.auth.postRegister');

    /* Reset Password */
    Route::get('/forgot-password','Customer\AuthController@forgotPassword')->name('customer.auth.forgot');
    Route::get('/password/reset/{token}', 'Customer\AuthController@showResetForm')->name('password.reset');
    Route::post('/password/email', 'Customer\AuthController@sendResetLink')->name('password.email');
    Route::post('/password/reset/update', 'Customer\AuthController@resetPassword')->name('password.update');

    /* Home */
    Route::get('/','Customer\DisplayController@displayHome')->name('customer.home');
    Route::get('/nuoc-hoa/{slug}','Customer\DisplayController@displayProduct')->name('customer.product');

    /* Cart and Checkout */
    Route::get('/cart','Customer\DisplayController@cart')->name('customer.cart');
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


    /* Post & Comment*/
    Route::get('/post/{slug}','BlogController@getPostBySlug')->name('customer.post.detail');
    
    /* Post by category */
    Route::get('/blogs/{slug}','BlogController@getPostByCategory')->name('customer.post.category');
});



//Payment
Route::prefix('payment')->group(function() {
    Route::get('/', 'PaymentController@displayPayment');
    Route::get('/create', 'PaymentController@createPayment');
    Route::get('/status', 'PaymentController@getPaymentStatus');
    Route::get('/refund', 'PaymentController@refundPayment');
    Route::get('/webhook', 'PaymentController@handleWebhook');
    Route::get('/get-all', 'PaymentController@getAllTransactions');
    Route::get('/cron', 'PaymentController@cron');
    Route::get('/check', 'PaymentController@checkPayment');


    Route::get('/ghn-webhook', 'PaymentController@ghnWebhook');
});



/* Telegram test */
Route::get('tele-test', 'Manager\System\SettingController@sendNotification');



/* Tra cứu đơn */
Route::get('/tra-cuu-don', function(){return view('manager.order.lookup');})->name('customer.lookup-order');
Route::get('/auto-update', function(){return view('manager.order.auto-update');})->name('customer.auto-order');