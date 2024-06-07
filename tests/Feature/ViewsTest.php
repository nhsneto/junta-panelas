<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('home page can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('registration page can be rendered', function () {
    $response = $this->get('/cadastro');

    $response->assertStatus(200);
});

test('login page can be rendered', function () {
    $response = $this->get('/entrar');

    $response->assertStatus(200);
});

test('dashboard page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('entrar'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get('/painel');

    $response->assertStatus(200);
});
