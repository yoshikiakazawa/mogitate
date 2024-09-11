<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products',[ProductController::class,'index'])->name('index');
Route::get('/products/search',[ProductController::class,'search'])->name('search');
Route::get('/products/register',[ProductController::class,'create'])->name('create');
Route::post('/products/store',[ProductController::class,'store'])->name('store');

Route::get('/products/{productId}',[ProductController::class,'detail'])->name('detail');
Route::put('/products/{productId}/update',[ProductController::class,'update'])->name('update');
Route::post('/products/{productId}/delete',[ProductController::class,'delete'])->name('delete');
