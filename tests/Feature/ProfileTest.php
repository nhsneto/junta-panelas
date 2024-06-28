<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should change the user\'s email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $former_updated_at = User::first()->updated_at;
    $newEmail = 'new@example.com';

    $response = $this->put(route('email.update'), [
        'current_email' => 'test@example.com',
        'new_email' => $newEmail,
        'new_email_confirmation' => $newEmail,
    ]);

    $user = User::first();

    expect($user->email)->toEqual($newEmail)
        ->and($user->updated_at)->not()->toEqual($former_updated_at);

    $response->assertRedirectToRoute('profile');
});

test('should fail when trying to change the user\'s email with no current email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => null,
        'new_email' => 'new@example.com',
        'new_email_confirmation' => 'new@example.com',
    ]);

    $response->assertInvalid('current_email');
});

test('should fail when trying to change the user\'s email with an invalid current email format', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'test',
        'new_email' => 'new@example.com',
        'new_email_confirmation' => 'new@example.com',
    ]);

    $response->assertInvalid('current_email');
});

test('should fail when trying to change the user\'s email with the wrong current email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'wrong@example.com',
        'new_email' => 'new@example.com',
        'new_email_confirmation' => 'new@example.com',
    ]);

    $response->assertInvalid('current_email');
});

test('should fail when trying to change the user\'s email without the new email', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'test@example.com',
        'new_email' => null,
        'new_email_confirmation' => 'new@example.com',
    ]);

    $response->assertInvalid('new_email');
});

test('should fail when trying to change the user\'s email with a new email that is longer than 255 characters', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'test@example.com',
        'new_email' => 'test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test@example.com',
        'new_email_confirmation' => 'test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test_test@example.com',
    ]);

    $response->assertInvalid('new_email');
});

test('should fail when trying to change the user\'s email with an invalid new email format', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'test@example.com',
        'new_email' => 'test',
        'new_email_confirmation' => 'new@example.com',
    ]);

    $response->assertInvalid('new_email');
});

test('should fail when trying to change the user\'s email with no new email confirmation', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'test@example.com',
        'new_email' => 'test',
        'new_email_confirmation' => null,
    ]);

    $response->assertInvalid('new_email');
});

test('should fail when trying to change the user\'s email with a different email confirmation', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'test@example.com',
        'new_email' => 'new@example.com',
        'new_email_confirmation' => 'wrong@example.com',
    ]);

    $response->assertInvalid('new_email');
});

test('should fail when trying to change the user\'s email with a new email that already exists', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    User::create([
        'name' => 'User',
        'email' => 'user@example.com',
        'password' => Hash::make('user1234'),
    ]);

    $this->post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'user1234',
    ]);

    $response = $this->put(route('email.update'), [
        'current_email' => 'user@example.com',
        'new_email' => 'test@example.com', // Email already exists
        'new_email_confirmation' => 'test@example.com',
    ]);

    $response->assertInvalid('new_email');
});

test('should change the user\'s password', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $former_updated_at = User::first()->updated_at;
    $newPassword = 'newpassword';

    $response = $this->put(route('password.update'), [
        'current_password' => 'password',
        'new_password' => $newPassword,
        'new_password_confirmation' => $newPassword,
    ]);

    $user = User::first();

    expect(Hash::check($newPassword, $user->password))->toBeTrue()
        ->and($user->updated_at)->not()->toEqual($former_updated_at);

    $response->assertRedirectToRoute('profile');
});

test('should fail when trying to change the user\'s password with no current password', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('password.update'), [
        'current_password' => null,
        'new_password' => 'newpassword',
        'new_password_confirmation' => 'newpassword',
    ]);

    $response->assertInvalid('current_password');
});

test('should fail when trying to change the user\'s password with wrong current password', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('password.update'), [
        'current_password' => 'wrongpassword',
        'new_password' => 'newpassword',
        'new_password_confirmation' => 'newpassword',
    ]);

    $response->assertInvalid('current_password');
});

test('should fail when trying to change the user\'s password with no new password', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('password.update'), [
        'current_password' => 'password',
        'new_password' => null,
        'new_password_confirmation' => 'newpassword',
    ]);

    $response->assertInvalid('new_password');
});

test('should fail when trying to change the user\'s password with the new password having less than 6 characters', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('password.update'), [
        'current_password' => 'password',
        'new_password' => '12345',
        'new_password_confirmation' => '12345',
    ]);

    $response->assertInvalid('new_password');
});

test('should fail when trying to change the user\'s password without password confirmation', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('password.update'), [
        'current_password' => 'password',
        'new_password' => 'newpassword',
        'new_password_confirmation' => null,
    ]);

    $response->assertInvalid('new_password');
});

test('should fail when trying to change the user\'s password with wrong password confirmation', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->put(route('password.update'), [
        'current_password' => 'password',
        'new_password' => 'newpassword',
        'new_password_confirmation' => 'wrongpassword',
    ]);

    $response->assertInvalid('new_password');
});

test('should delete the user', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->delete(route('user.delete'));

    expect(User::all())->toBeEmpty();
    $response->assertRedirect('/');
});
