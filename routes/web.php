<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'index']);
Route::get('/create', [StudentController::class, 'create'])->name('create');
Route::post('/create', [StudentController::class, 'store'])->name('store');
