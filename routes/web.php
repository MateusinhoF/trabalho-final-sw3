<?php

use App\Http\Controllers\AcessoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/registrese', [AuthController::class, 'create'])->name('registrese');
Route::post('/store', [AuthController::class, 'store'])->name('store');
Route::post('/logar', [AuthController::class, 'logar'])->name('logar');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/403', [AcessoController::class , 'acessoNegado403'])->name('403');

Route::middleware(['auth', 'vendedor'])->group(function(){
    
    Route::get('/vendedor', [VendedorController::class, 'index'])->name('vendedor.index');
    Route::get('/vendedor/create', [VendedorController::class, 'create'])->name('vendedor.create');
    Route::post('/vendedor', [VendedorController::class, 'store'])->name('vendedor.store');
    Route::get('/vendedor/{id}/edit', [VendedorController::class, 'edit'])->name('vendedor.edit');
    Route::post('/vendedor/{id}', [VendedorController::class, 'update'])->name('vendedor.update');
    Route::get('/vendedor/{id}', [VendedorController::class, 'destroy'])->name('vendedor.destroy');
});

Route::middleware(['auth', 'comprador'])->group(function(){
    Route::get('/comprador', [CompradorController::class, 'index'])->name('comprador.index');
    Route::get('/comprador/comprar/{id_produto}', [CompradorController::class, 'comprar'])->name('comprador.comprar');
    Route::get('/comprador/carrinho/listar', [CompradorController::class, 'carrinho'])->name('comprador.carrinho');
    Route::post('/comprador/carrinho/{id_produto}', [CompradorController::class, 'adicionaraocarrinho'])->name('comprador.adicionaraocarrinho');
    Route::get('/comprador/carrinho/finalizarcompra/{id_codigo_do_pedido}', [CompradorController::class, 'finalizarcompra'])->name('comprador.finalizarcompra');
    Route::get('/comprador/carrinho/retirarproduto/{id_pedido}', [CompradorController::class, 'retirarproduto'])->name('comprador.retirarproduto');
    Route::get('/comprador/pedidos/listar', [CompradorController::class, 'pedidos'])->name('comprador.pedidos');
    Route::get('/comprador/pedidos/detalhar/{id_pedido}', [CompradorController::class, 'detalhespedido'])->name('comprador.detalhespedido');
});