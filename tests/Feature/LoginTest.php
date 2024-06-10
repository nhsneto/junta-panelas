<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should log the user in the system', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirectToRoute('dashboard');
});

test('should fail when trying to log into the system without email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => null,
        'password' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to log into the system using an invalid email format', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@',
        'password' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to log into the system without password', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => null,
    ]);

    $response->assertInvalid('password');
});

test('should fail when trying to log into the system with nonexistent email in the database', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'foo@bar.com',
        'password' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to log into the system with wrong password', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'foo1234',
    ]);

    // When login credential error occurs (email or password), the 'email' field is the chosen to get the error message
    $response->assertInvalid('email');
});

test('should fail when trying to log into the system using wrong credentials after 5 attempts', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $numberOfAttempts = 6;
    for ($i = 0; $i < $numberOfAttempts; $i++) {
        $response = $this->post(route('login'), [
            'email' => 'foo@bar.com',
            'password' => 'foo1234',
        ]);
    }

    // When the login rate limit exceeds, the 'email' field is the chosen to get the error message
    $response->assertInvalid([
        'email' => 'Limite de tentativas excedido. Tente novamente em 5 minutos.'
    ]);
});

test('should log the user out of the system', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->delete(route('logout'));

    $response->assertRedirect('/');
});
