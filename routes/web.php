<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

//********ROTAS PARA UTILIZADORES************//
Route::get('/addusers', [UserController::class, 'addUsers'])->name("users.add");//rota para adicionar utilizador
Route::post('/storeuser', [UserController::class, 'storeUser'])->name("users.store");//rota para guardar utilizador


//********ROTA PARA PÁGINAS LOGIN E REGISTO************
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');//rota para página de login
    Route::post('/', [AuthController::class, 'login']); // rota para login
    Route::get('/registo', [AuthController::class, 'showRegister'])->name('register'); // rota para página de registo
    Route::post('/registo', [AuthController::class, 'register']); // rota para registo
});

//********ROTA PARA LOGOUT************//
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


//********ROTAS PROTEGIDAS************
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');//rota para página de dashboard

    // Movimentos
    Route::prefix('movements')->name('movements.')->group(function () {
        // Apenas Admin pode adicionar/editar/apagar
        Route::middleware('admin')->group(function () {
            Route::get('/adicionar', [MovementController::class, 'create'])->name('create');
            Route::post('/store', [MovementController::class, 'store'])->name('store');
            Route::get('/editar', [MovementController::class, 'edit'])->name('edit');
            Route::put('/{id}', [MovementController::class, 'update'])->name('update');
            Route::get('/apagar', [MovementController::class, 'delete'])->name('delete');
            Route::delete('/{id}', [MovementController::class, 'destroy'])->name('destroy');
        });
    });
});



//********ROTA PARA FALLBACK************
Route::fallback(function () {
    return view('utils.fallback'); //return view reencaminha para a pasta views na pasta utils o ficheiro fallback.blade.php
});
