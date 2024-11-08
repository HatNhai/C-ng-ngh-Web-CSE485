<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SaleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\IssueController;

Route::resource('sales', SaleController::class);
Route::resource('students', StudentController::class);
Route::resource('issues', IssueController::class);