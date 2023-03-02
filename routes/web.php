<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoItensController;
use App\Http\Controllers\ProdutoController;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;

//CATEGORIAS
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categoria/create', [CategoriaController::class, 'create']);
Route::post('/categoria/store', [CategoriaController::class, 'store']);
Route::get('/categoria/{id}', [CategoriaController::class, 'show']);
Route::post('/categoria/update', [CategoriaController::class, 'update']);
Route::post('/categoria/delete', [CategoriaController::class, 'delete']);


//PRODUTOS
//LEMBRETE: CORRIGIR O 'EDITAR'
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produto/create',[ProdutoController::class, 'create']);
Route::post('/produto/store', [ProdutoController::class, 'store']);
Route::get('/produto/{id}', [ProdutoController::class, 'show']);
Route::post('/produto/update', [ProdutoController::class, 'update']);
Route::post('/produto/delete', [ProdutoController::class, 'delete']);




//CARDÁPIO
Route::get('/cardapio', [CardapioController::class, 'index']);
Route::get('/cardapio/create', [CardapioController::class, 'create']);
Route::post('/cardapio/store', [CardapioController::class, 'store']);
Route::get('/cardapio/{id}', [CardapioController::class, 'show']);
Route::post('/cardapio/update', [CardapioController::class, 'update']);
Route::post('/cardapio/delete', [CardapioController::class, 'delete']);


//PEDIDO
Route::get('/pedidos', [PedidoController::class, 'index']);
Route::get('/pedido/create', [PedidoController::class, 'create']);
Route::post('/pedido/store', [PedidoController::class, 'store']);
Route::get('/pedido/{id}', [PedidoController::class, 'show']);
Route::post('/pedido/update', [PedidoController::class, 'update']);
Route::post('/pedido/cancelar', [PedidoController::class, 'cancelar']);
Route::get('/pedido/detalhes/{id}', [PedidoController::class, 'visualizar']);
Route::post('/pedido/detalhes/status/pronto', [PedidoController::class,'statusPedido']);