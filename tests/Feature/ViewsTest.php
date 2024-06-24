<?php

use App\Models\JuntaPanelas;
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

    $this->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '08:30',
    ]);

    $response = $this->get(route('junta-panelas.edit', [
        'juntaPanelas' => JuntaPanelas::first()
    ]));

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

    $response = $this->get(route('participant.index'));

    $response->assertStatus(200);
});

test('junta-panelas show page can be rendered', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->get(route('junta-panelas.show'));

    $response->assertStatus(200);
});
