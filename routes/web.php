<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Route cho trang chào mừng
Route::get('/', function () {
    return view('welcome');
});

// Route cho resource articles
Route::resource('articles', ArticleController::class);
