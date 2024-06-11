<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JuntaPanelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [SessionController::class, 'create'])
        ->name('login');

    Route::post('login', [SessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('junta-panelas', [JuntaPanelasController::class, 'index'])
        ->name('junta-panelas.index');

    Route::get('junta-panelas/create', [JuntaPanelasController::class, 'create'])
        ->name('junta-panelas.create');

    Route::delete('logout', [SessionController::class, 'destroy'])
        ->name('logout');
});
