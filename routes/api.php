<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => 'product'
], function() {

    Route::get('',[ProductController::class,'index'])
    ->name('product.all');

    Route::get('/{id}',[ProductController::class,'show'])
    ->name('product.find');

    Route::post('/store',[ProductController::class,'store'])
    ->name('product.store');

    Route::get('/edit/{id}',[ProductController::class,'edit'])
    ->name('product.edit');

    Route::post('/update/{id}',[ProductController::class,'update'])
    ->name('product.update');

    Route::post('/delete/{id}',[ProductController::class,'destroy'])
    ->name('product.destory');

});
