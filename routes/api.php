<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::resource('products', ProductController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);    