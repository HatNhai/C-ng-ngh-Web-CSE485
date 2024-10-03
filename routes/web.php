<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

Route::resource('authors', AuthorController::class);
