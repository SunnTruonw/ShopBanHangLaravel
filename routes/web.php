<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;




Route::get('/admin/users/login', [LoginController::class, 'index']);
Route::post('/admin/users/login/store', [LoginController::class, 'store']);

Route::prefix('admin')->group(function () {
    
    Route::get('main', [MainController::class, 'index']);


    #menu
    Route::prefix('menu')->group(function () {
        Route::get('add', [MenuController::class, 'create']);
        Route::post('add', [MenuController::class, 'store']);
        Route::get('list', [MenuController::class, 'index']);
        Route::post('edit/{menu}', [MenuController::class, 'update']);
        Route::get('edit/{menu}', [MenuController::class, 'show']);
        Route::delete('destroy', [MenuController::class, 'destroy']);
        
 
    });

    #product
    Route::prefix('product')->group(function () {
        Route::get('add', [ProductController::class, 'create']);
        Route::post('add', [ProductController::class, 'store']);
        Route::get('list', [ProductController::class, 'index']);
        Route::get('edit/{product}', [ProductController::class, 'show']);
        Route::post('edit/{product}', [ProductController::class, 'update']);
        Route::delete('destroy', [ProductController::class, 'destroy']);


        
    });

    #Slider
    Route::prefix('sliders')->group(function () {
        Route::get('add', [SliderController::class, 'create']);
        Route::post('add', [SliderController::class, 'store']);
        Route::get('list', [SliderController::class, 'index']);
        Route::get('edit/{slider}', [SliderController::class, 'show']);
        Route::post('edit/{slider}', [SliderController::class, 'update']);
        Route::delete('destroy', [SliderController::class, 'destroy']);


        
    });

    #upload

    Route::post('upload/services', [UploadController::class, 'store']);
    
    // Route::get('storage/{uploads}', function ($uploads)
    // {
    //     return Image::make(storage_path('public/' . $uploads))->response();
    // });


    Route::get('customer', [App\Http\Controllers\Admin\CartController::class, 'index']);
    Route::get('customer/view/{customer}', [App\Http\Controllers\Admin\CartController::class, 'show']);
    Route::delete('customer/destroy', [App\Http\Controllers\Admin\CartController::class, 'destroy']);


});



Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);

Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);

Route::post('/add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('/carts', [App\Http\Controllers\CartController::class, 'show']);
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('/carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('/carts', [App\Http\Controllers\CartController::class, 'addCart']);








