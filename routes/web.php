<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JuntaPanelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('cadastro', [RegisteredUserController::class, 'create'])
        ->name('cadastro');

    Route::post('cadastro', [RegisteredUserController::class, 'store']);

    Route::get('entrar', [SessionController::class, 'create'])
        ->name('entrar');

    Route::post('entrar', [SessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('painel', [JuntaPanelasController::class, 'index'])
        ->name('painel');
});
