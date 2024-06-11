<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should register user', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $createdUser = User::where('email', 'test@example.com')->first();

    expect($createdUser->id)->toBeTruthy()
        ->and($createdUser->name)->toBe('Test User')
        ->and($createdUser->email)->toBe('test@example.com')
        ->and(Hash::check('password', $createdUser->password))->toBeTrue();

    $response->assertRedirectToRoute('junta-panelas.index');
});

// NAME TESTS

test('should fail when trying to register user without name', function () {
    $data = [
        'name' => null,
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('name');
});

test('should fail when trying to register user whose name is less than 2 characters', function () {
    $data = [
        'name' => 'T',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('name');
});

test('should fail when trying to register user whose name is only numeric', function () {
    $data = [
        'name' => '12345',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('name');
});

// EMAIL TESTS

test('should fail when trying to register user without email', function () {
    $data = [
        'name' => 'Test User',
        'email' => null,
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('email');
});

test('should fail when trying to register user using an invalid email format', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('email');
});

test('should fail when trying to register user with a duplicate email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $data = [
        'name' => 'Another Test User',
        'email' => 'test@example.com', // This email already exists in the database
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('email');
});

// SENHA TESTS

test('should fail when trying to register user without password', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => null,
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('password');
});

test('should fail when trying to register user without password confirmation', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => null,
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('password');
});

test('should fail when trying to register user with a different password confirmation', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'diffpassword',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('password');
});

test('should fail when trying to register user whose password is less than 6 characters', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'a#123',
        'password_confirmation' => 'a#123',
    ];

    $response = $this->post(route('register'), $data);

    $response->assertInvalid('password');
});
