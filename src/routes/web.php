<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products',[ProductController::class,'index'])->name('index');
Route::get('/products/search',[ProductController::class,'search'])->name('search');
Route::get('/products/{productId}',[ProductController::class,'detail'])->name('detail');
Route::post('/products/{productId}/update',[ProductController::class,'update'])->name('update');
Route::post('/products/{productId}/delete',[ProductController::class,'delete'])->name('delete');

