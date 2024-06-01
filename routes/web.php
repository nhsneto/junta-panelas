<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('cadastro', [RegisteredUserController::class, 'create'])
    ->name('cadastro');

Route::post('cadastro', [RegisteredUserController::class, 'store']);
