<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Home\CardController;
use App\Http\Controllers\Home\HomeController as HomeHomeController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\ProfileController;


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


Route::prefix('/admin-panel')->middleware('auth')->name('admin.')->group(function () {

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

    Route::post('/checkOTP', [AuthController::class, 'checkOTP']);

    Route::any('/product/{product:slug}', [HomeProductController::class, 'index'])->name('product.details');

    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('home.index');
    })->name('logout');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');



    Route::get('/compare' , [HomeHomeController::class , 'compareIndex'])->name('compare.index');

    Route::get('/compare/{product:id}' , [HomeHomeController::class , 'compare'])->name('compare.add');

    Route::get('/compare/{product:id}/delete' , [HomeHomeController::class , 'delete'])->name('compare.delete');


    Route::get('/cart' , [CardController::class , 'index'])->name('cart.index');
    Route::post('/cart-add' , [CardController::class , 'add'])->name('cart.add');

    Route::post('/cart-update' , [CardController::class , 'update'])->name('cart.update');

    Route::get('/cart-delete/{id}' , [CardController::class , 'delete'])->name('cart.delete');

});



Route::get('/test' , function(){
    Cart::clear();
    // dd(\Cart::getContent());
});
