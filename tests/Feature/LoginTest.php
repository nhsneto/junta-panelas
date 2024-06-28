<?php

use App\Models\User;

test('should log the user in the system', function () {
    $user = User::factory()->create();

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirectToRoute('junta-panelas.index');
});

test('should fail when trying to log into the system without email', function () {
    $response = $this->post(route('login'), [
        'email' => null,
        'password' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to log into the system using an invalid email format', function () {
    $response = $this->post(route('login'), [
        'email' => 'test@',
        'password' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to log into the system without password', function () {
    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => null,
    ]);

    $response->assertInvalid('password');
});

test('should fail when trying to log into the system with nonexistent email in the database', function () {
    User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $response = $this->post(route('login'), [
        'email' => 'foo@bar.com',
        'password' => 'password',
    ]);

    $response->assertInvalid('email');
});

test('should fail when trying to log into the system with wrong password', function () {
    User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'foo1234',
    ]);

    // When login credential error occurs (email or password), the 'email' field is the chosen to get the error message
    $response->assertInvalid('email');
});

test('should fail when trying to log into the system using wrong credentials after 5 attempts', function () {
    User::factory()->create([
        'email' => 'test@example.com',
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
        'email' => __('Limit exceeded. Try again in 5 minutes.'),
    ]);
});

test('should log the user out of the system', function () {
    User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->delete(route('logout'));

    $response->assertRedirect('/');
});
