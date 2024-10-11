<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});


// Route cho trang đăng nhập
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('/error', function () {
    return view('errors.access-denied');
})->name('error.page');
Route::get('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => ['auth:sanctum', 'role.web:admin']], function() {
    Route::get('/admin2', [AdminController::class, 'index'])->name('admin.index');
    Route::get('admin2/check', function(Request $request) {
        return $request->user();
    });
});

Route::group(['middleware' => ['auth:sanctum', 'permission.web:edit_products']], function() {
    Route::post('/products/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/check', function(Request $request) {
        return $request->user();
    });
    Route::get('/products/view', function(Request $request) {
        return 'co quyen view';
    });

});

/* 
Route::get('/roles', [RoleController::class, 'index'])->middleware(['auth:sanctum', 'role.web:admin','permission.web:user_permission'])->name('roles.index');
*/


Route::get('/roles', [RoleController::class, 'index'])->middleware(['auth:sanctum', 'role.web:admin'])->name('roles.index');
Route::post('/roles', [RoleController::class, 'store'])->middleware(['auth:sanctum'])->name('roles.store');
Route::post('/roles/assign/{roleId}', [RoleController::class, 'assignPermissions'])->middleware(['auth:sanctum'])->name('roles.assignPermissions');
//update role name
Route::get('/roles/{role}', [RoleController::class, 'show'])->middleware(['auth:sanctum']);
Route::put('/roles/update', [RoleController::class, 'update'])->name('roles.update')->middleware(['auth:sanctum']);

//Assign or delete role for user
// Route để hiển thị quản lý role của người dùng
Route::get('/users/manage-roles', [UserController::class, 'manageRoles'])
    ->middleware(['auth:sanctum'])
    ->name('users.manageRoles');

// Route để gán role cho người dùng
Route::post('/users/{user}/assign-roles', [UserController::class, 'assignRoles'])
    ->middleware(['auth:sanctum'])
    ->name('users.assignRoles');

// Route để xóa role của người dùng
Route::post('/users/{user}/remove-roles', [UserController::class, 'removeRoles'])
    ->middleware(['auth:sanctum'])
    ->name('users.removeRoles');
    
Route::get('/users/{user}/roles', [UserController::class, 'getRoles'])->middleware(['auth:sanctum'])->name('users.getRoles');


Route::post('/permissions', [PermissionController::class, 'store'])->middleware(['auth:sanctum'])->name('permissions.store');

Route::delete('/roles', [RoleController::class, 'deleteRole'])->middleware(['auth:sanctum'])->name('roles.delete');
Route::delete('/permissions', [PermissionController::class, 'deletePermission'])->middleware(['auth:sanctum'])->name('permissions.delete');

//sử dụng middleware động để khi thêm role mới sẽ không bị ảnh hưởng như trường hợp sử dụng 'role.web:admin', vì gia sử thêm 1 route mới thì không thể sử dụng middleware tĩnh 'role.web:admin','role.web:edittor',...
//nếu hệ thống phân quyền không quá phức tạp hoặc không cho người dùng tự tạo role, chỉ dùng những role có sẵn thì có thể sử dụng 'role.web:admin', 'role.web:edittor',... => tức role tĩnh trong code
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/roles2', [RoleController::class, 'index'])->middleware('permission.web:user_permission')->name('roles.index');
    Route::get('/role-check-2', function(){return 'co quyen xem';})->middleware('permission.web:user_permission')->name('roles.index');
});


/* Admin */
Route::prefix('admin')->group(function() {
    
    //admin.index
    Route::group(['middleware' => ['auth:sanctum', 'permission.web:user_permission']], function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/check', function(Request $request) {
            return $request->user();
        });
    });

    // Nhóm route khác cũng thuộc prefix 'admin'
    Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        // Thêm các route khác tại đây
    });

    // Bạn có thể thêm nhiều nhóm route khác tại đây
});