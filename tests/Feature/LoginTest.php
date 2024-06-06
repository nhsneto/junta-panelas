<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should log the user in the system', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('entrar'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirectToRoute('painel');
});

test('should fail when trying to log into the system without email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('entrar'), [
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

    $response = $this->post(route('entrar'), [
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

    $response = $this->post(route('entrar'), [
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

    $response = $this->post(route('entrar'), [
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

    $response = $this->post(route('entrar'), [
        'email' => 'test@example.com',
        'password' => 'foo1234',
    ]);

    // When login credential error occurs (email or password), the 'email' field is the chosen to get the error message
    $response->assertInvalid('email');
});
