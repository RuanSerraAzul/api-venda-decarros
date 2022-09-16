<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Carros;
use App\Http\Controllers\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('auth.register'); //registra um novo vendedor
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); //loga o vendedor

Route::group(['middleware' => 'auth:api'], function () { //grupo de rotas autenticadas
    Route::post('/me', [AuthController::class, 'me'])->name('auth.me'); //retorna os dados dos jornalistas

    Route::post('/clientes/create', [Clientes::class, 'store'])->name('clientes.create'); //cria um novo cliente
    Route::get('/clientes/lista', [Clientes::class, 'list'])->name('clientes.listar'); //lista todos os clientes
    Route::post('/clientes/delete/{id}', [Clientes::class, 'delete'])->name('clientes.delete'); //cria um novo cliente


    Route::post('/carros/create', [Carros::class, 'store'])->name('carros.create'); //adicionar um carro ao banco de dados
});