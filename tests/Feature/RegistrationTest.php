<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should register user', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $createdUser = User::where('email', 'test@example.com')->first();

    expect($createdUser->id)->toBeTruthy()
        ->and($createdUser->name)->toBe('Test User')
        ->and($createdUser->email)->toBe('test@example.com')
        ->and(Hash::check('password', $createdUser->password))->toBeTrue();

    $response->assertRedirectToRoute('junta-panelas.index');
});

test('should fail when trying to register user without name', function () {
    $response = $this->post(route('register'), [
        'name' => null,
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('name');
});

test('should fail when trying to register user whose name is less than 2 characters', function () {
    $response = $this->post(route('register'), [
        'name' => 'T',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('name');
});

test('should fail when trying to register user whose name is only numeric', function () {
    $response = $this->post(route('register'), [
        'name' => '12345',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('name');
});

test('should fail when trying to register user without email', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => null,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to register user using an invalid email format', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to register user with an email that is longer than 255 characters', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to register user with a duplicate email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post(route('register'), [
        'name' => 'Another Test User',
        'email' => 'test@example.com', // This email already exists in the database
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to register user without password', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => null,
        'password_confirmation' => 'password',
    ]);

    $response->assertInvalid('password');
});

test('should fail when trying to register user without password confirmation', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => null,
    ]);

    $response->assertInvalid('password');
});

test('should fail when trying to register user with a different password confirmation', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'diffpassword',
    ]);

    $response->assertInvalid('password');
});

test('should fail when trying to register user whose password is less than 6 characters', function () {
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'a#123',
        'password_confirmation' => 'a#123',
    ]);

    $response->assertInvalid('password');
});
