<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThesisController;

Route::resource('theses', ThesisController::class);
