<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'form']);
Route::post('/post', [WelcomeController::class, 'post']);
