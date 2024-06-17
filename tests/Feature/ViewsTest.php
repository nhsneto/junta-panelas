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

test('junta-panelas index page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get(route('junta-panelas.index'));

    $response->assertStatus(200);
});

test('junta-panelas create page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get(route('junta-panelas.create'));

    $response->assertStatus(200);
});

test('junta-panelas edit page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get(route('junta-panelas.edit'));

    $response->assertStatus(200);
});

test('junta-panelas profile page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get(route('profile'));

    $response->assertStatus(200);
});

test('junta-panelas participants page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get(route('junta-panelas.participants'));

    $response->assertStatus(200);
});
