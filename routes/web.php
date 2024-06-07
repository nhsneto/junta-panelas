<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('cadastro', [RegisteredUserController::class, 'create'])
    ->name('cadastro');

Route::post('cadastro', [RegisteredUserController::class, 'store']);

Route::get('entrar', [SessionController::class, 'create'])
    ->name('entrar');

Route::post('entrar', [SessionController::class, 'store']);

Route::get('painel', function () {})
    ->name('painel');
