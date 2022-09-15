<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('auth.register'); //registra um novo vendedor
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); //loga o vendedor