<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JuntaPanelasController;
use App\Http\Controllers\ProfileController;
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

    Route::get('junta-panelas/show', [JuntaPanelasController::class, 'show'])
        ->name('junta-panelas.show');

    Route::get('junta-panelas/create', [JuntaPanelasController::class, 'create'])
        ->name('junta-panelas.create');

    Route::post('junta-panelas', [JuntaPanelasController::class, 'store'])
        ->name('junta-panelas.store');

    Route::get('junta-panelas/edit', [JuntaPanelasController::class, 'edit'])
        ->name('junta-panelas.edit');

    Route::put('junta-panelas/{juntaPanelas}', [JuntaPanelasController::class, 'update'])
        ->name('junta-panelas.update');

    Route::get('junta-panelas/participants', [JuntaPanelasController::class, 'participants'])
        ->name('junta-panelas.participants');

    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::delete('logout', [SessionController::class, 'destroy'])
        ->name('logout');
});
