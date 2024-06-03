<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should register user', function () {
    $data = [
        'nome' => 'Test User',
        'email' => 'test@example.com',
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ];

    $this->post('/cadastro', $data);

    $createdUser = User::where('email', 'test@example.com')->first();

    expect($createdUser->id)->toBeTruthy()
        ->and($createdUser->nome)->toBe('Test User')
        ->and($createdUser->email)->toBe('test@example.com')
        ->and(Hash::check('password', $createdUser->senha))->toBeTrue();
});

// NAME TESTS

test('should fail when trying to register user without name', function () {
    $data = [
        'nome' => null,
        'email' => 'test@example.com',
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('nome');
});

test('should fail when trying to register user whose name is less than 2 characters', function () {
    $data = [
        'nome' => 'T',
        'email' => 'test@example.com',
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('nome');
});

test('should fail when trying to register user whose name is only numeric', function () {
    $data = [
        'nome' => '12345',
        'email' => 'test@example.com',
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('nome');
});

// EMAIL TESTS

test('should fail when trying to register user without email', function () {
    $data = [
        'nome' => 'Test User',
        'email' => null,
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('email');
});

test('should fail when trying to register user using an invalid email format', function () {
    $data = [
        'nome' => 'Test User',
        'email' => 'test',
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('email');
});

test('should fail when trying to register user with a duplicate email', function () {
    User::create([
        'nome' => 'Test User',
        'email' => 'test@example.com',
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ]);

    $data = [
        'nome' => 'Another Test User',
        'email' => 'test@example.com', // This email already exists in the database
        'senha' => 'password',
        'senha_confirmation' => 'password',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('email');
});

// SENHA TESTS

test('should fail when trying to register user without password', function () {
    $data = [
        'nome' => 'Test User',
        'email' => 'test@example.com',
        'senha' => null,
        'senha_confirmation' => 'password',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('senha');
});

test('should fail when trying to register user without password confirmation', function () {
    $data = [
        'nome' => 'Test User',
        'email' => 'test@example.com',
        'senha' => 'password',
        'senha_confirmation' => null,
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('senha');
});

test('should fail when trying to register user with a different password confirmation', function () {
    $data = [
        'nome' => 'Test User',
        'email' => 'test@example.com',
        'senha' => 'password',
        'senha_confirmation' => 'diffpassword',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('senha');
});

test('should fail when trying to register user whose password is less than 6 characters', function () {
    $data = [
        'nome' => 'Test User',
        'email' => 'test@example.com',
        'senha' => 'a#123',
        'senha_confirmation' => 'a#123',
    ];

    $response = $this->post('/cadastro', $data);

    $response->assertInvalid('senha');
});
