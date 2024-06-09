<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('home page can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('registration page can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

test('login page can be rendered', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

test('dashboard page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get(route('dashboard'));

    $response->assertStatus(200);
});
