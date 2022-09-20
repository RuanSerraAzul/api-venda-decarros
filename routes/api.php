<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Carros;
use App\Http\Controllers\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('auth.register'); //registra um novo vendedor
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); //loga o vendedor

Route::group(['middleware' => 'auth:api'], function () { //grupo de rotas autenticadas
    Route::post('/me', [AuthController::class, 'me'])->name('auth.me'); //retorna os dados dos vendedor

    Route::post('/clientes/create', [Clientes::class, 'store'])->name('clientes.create'); //cria um novo cliente
    Route::get('/clientes/lista', [Clientes::class, 'list'])->name('clientes.listar'); //lista todos os clientes
    Route::post('/clientes/delete/{id}', [Clientes::class, 'delete'])->name('clientes.delete'); //cria um novo cliente


    Route::post('/carros/create', [Carros::class, 'store'])->name('carros.create'); //adicionar um carro ao banco de dados
    Route::get('/carros/lista',[Carros::class, 'list'])->name('carros.lista'); //listar todos os carros 
    Route::post('/carros/delete/{id}',[Carros::class, 'delete'])->name('carros.delete'); //deletar um carro 
    Route::get('/carros/ver/{id}', [Carros::class, 'show'])->name('carros,ver.id'); //visualizar todas as informações de um carro

    Route::get('/vendas/lista', [Vendas::class, 'list'])->name('vendas.lista'); //listar vendas
    Route::post('/vendas/create', [Vendas::class, 'store'])->name('vendas.create'); //adicionar vendas
    Route::get('/vendas/ver/{id}', [Vendas::class, 'show'])->name('vendas.ver.id'); //listar vendas
});