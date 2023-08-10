<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Home\HomeController as HomeHomeController;
use App\Http\Controllers\Home\PayTestController;
use App\Http\Controllers\Home\ShopController;

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


Route::prefix('/admin-panel')->name('admin.')->group(function(){

    Route::get('/dashboard', [HomeController::class , 'index'] )->name('dashboard');

    Route::resource('/brands', BrandController::class );

    Route::resource('/attributes', AttributeController::class );

    Route::resource('/categories', CategoryController::class );
    Route::post('/categories/attribute/{id}', [CategoryController::class , 'attribute'] )->name('categories.attribute');

    Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);

    Route::get('/updateParentCategory', [CategoryController::class , 'updateParentCategory'] )->name('updateParentCategory');

    Route::resource('/tags', TagController::class );



    Route::resource('/products', ProductController::class );
    Route::get('/products/image/{product}/category_edit', [ProductController::class , 'category_edit'] )->name('products.category.edit');



    Route::get('/products/image/{product}/edit', [ProductImageController::class , 'edit'] )->name('products.images.edit');

    Route::post('/products/image/{product}/add', [ProductImageController::class , 'add'] )->name('products.images.add');

    Route::any('/products/image/{image_id}/delete', [ProductImageController::class , 'delete'] )->name('products.images.destroy');

    Route::put('/products/image/{product}/set_primary', [ProductImageController::class , 'set_primary'] )->name('products.images.set_primary');


    Route::resource('/banner', BannerController::class );


});




Route::prefix('/')->name('home.')->group(function(){

    Route::get('' , [HomeHomeController::class , 'index'])->name('index');
    Route::get('/parent_categories' , [HomeHomeController::class , 'parent_categories'])->name('parent_categories');

    Route::get('/{category:slug}' , [ShopController::class , 'index'])->name('shop');

});
