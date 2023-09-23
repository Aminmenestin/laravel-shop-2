<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ProfileMiddleware;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Home\CardController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Home\OrderController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Home\ProfileController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Home\HomeController as HomeHomeController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('/admin-panel')->middleware('auth' , 'role:super-admin|admin|writer')->name('admin.')->group(function () {

    Route::resource('/users' , UserController::class);
    Route::resource('/permissions' , PermissionController::class);
    Route::resource('/roles' , RoleController::class);

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('/brands', BrandController::class);

    Route::resource('/attributes', AttributeController::class);

    Route::resource('/categories', CategoryController::class);
    Route::post('/categories/attribute/{id}', [CategoryController::class, 'attribute'])->name('categories.attribute');

    Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);

    Route::get('/updateParentCategory', [CategoryController::class, 'updateParentCategory'])->name('updateParentCategory');

    Route::resource('/tags', TagController::class);



    Route::resource('/products', ProductController::class);
    Route::get('/products/{product}/category_edit', [ProductController::class, 'category_edit'])->name('products.category.edit');

    Route::put('/products/{product}/category_update', [ProductController::class, 'category_update'])->name('products.category.update');



    Route::get('/products/image/{product}/edit', [ProductImageController::class, 'edit'])->name('products.images.edit');

    Route::post('/products/image/{product}/add', [ProductImageController::class, 'add'])->name('products.images.add');

    Route::any('/products/image/{image_id}/delete', [ProductImageController::class, 'delete'])->name('products.images.destroy');

    Route::put('/products/image/{product}/set_primary', [ProductImageController::class, 'set_primary'])->name('products.images.set_primary');


    Route::resource('/banner', BannerController::class);


    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/{comment:id}', [CommentController::class, 'show'])->name('comments.show');
    Route::get('/comments/{comment:id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::get('/comments/{comment:id}/delete', [CommentController::class, 'delete'])->name('comments.delete');


});




Route::prefix('/')->name('home.')->group(function () {

    Route::get('', [HomeHomeController::class, 'index'])->name('index');

    Route::get('/parent_categories', [HomeHomeController::class, 'parent_categories'])->name('parent_categories');

    Route::get('/categories/{category:slug}', [HomeCategoryController::class, 'show'])->name('categories.show');

    Route::any('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/preventReloading', [AuthController::class, 'preventReloading'])->name('login.preventReloading');
    Route::get('/wrongNumber', [AuthController::class, 'wrongNumber'])->name('login.wrongNumber');

    Route::post('/checkOTP', [AuthController::class, 'checkOTP']);

    Route::any('/product/{product:slug}', [HomeProductController::class, 'index'])->name('product.details');

    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('home.index');
    })->name('logout');


    Route::get('/profile/{any?}', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth' , ProfileMiddleware::class);
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::post('/profile/address/create', [ProfileController::class, 'addressCreate'])->name('profile.address.Create')->middleware('auth');


    Route::post('/payment' , [PaymentController::class , 'payment'])->name('payment');
    Route::get('/payment-verify/{getwayname}' , [PaymentController::class , 'paymentVerify'])->name('payment.verify');


    Route::get('/compare' , [HomeHomeController::class , 'compareIndex'])->name('compare.index');

    Route::get('/compare/{product:id}' , [HomeHomeController::class , 'compare'])->name('compare.add');

    Route::get('/compare/{product:id}/delete' , [HomeHomeController::class , 'delete'])->name('compare.delete');


    Route::get('/cart' , [CardController::class , 'index'])->name('cart.index');
    Route::post('/cart-add' , [CardController::class , 'add'])->name('cart.add');

    Route::post('/cart-update' , [CardController::class , 'update'])->name('cart.update');

    Route::get('/cart-delete/{id}' , [CardController::class , 'delete'])->name('cart.delete');
    Route::get('/cart-clear' , [CardController::class , 'clear'])->name('cart.clear');

    Route::get('/cart-info' , [CardController::class , 'info'])->name('cart.info');

    route::post('/couponcheck' , [CardController::class , 'couponcheck'])->name('cart.couponcheck');


    Route::get('/order' , [OrderController::class , 'index'])->name('order.index');
    Route::get('/order-citiesInfo' , [OrderController::class , 'citiesInfo'])->name('order.citiesInfo');

});



Route::get('/test/{any?}' , function(){
    // session()->forget('coupon');
    // dd(session()->all());
    // Cart::clear();
    // dd(request()->segment(count(request()->segments())) );
    // session()->put('login' , true);
    // session()->flush();
    // session()->put('login_token' , ['login_token'=> 'login_token'  , 'number' => '09132969940' , 'expired_time' => (Carbon::now()->addMinutes(10)->toTimeString()) ]);
    dd(request()->is('/test'));
    // dd(Carbon::format());
})->name('test');
