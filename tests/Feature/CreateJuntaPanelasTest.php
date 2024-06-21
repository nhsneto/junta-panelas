<?php

use App\Models\JuntaPanelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should create a junta-panelas planning', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $title = 'John doe party';
    $date = now()->addDay()->format('Y-m-d');
    $time = '14:10';

    $response = $this->post(route('junta-panelas.store'), [
        'title' => $title,
        'date' => $date,
        'time' => $time,
    ]);

    $jp = JuntaPanelas::first();
    $timestamp = strtotime($date . $time);
    $iso8601Date = date('c', $timestamp);

    expect($jp->id)->toBeTruthy()
        ->and($jp->title)->toBe($title)
        ->and($jp->date)->toBe($iso8601Date);

    $response->assertRedirectToRoute('junta-panelas.index');
});

test('should fail when trying to create a junta-panelas planning without title', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post(route('junta-panelas.store'), [
        'title' => null,
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '5:30',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to create a junta-panelas planning whose title has more than 255 characters', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post(route('junta-panelas.store'), [
        'title' => 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test T',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '14:10',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to create a junta-panelas planning with no date', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => null,
        'time' => '14:10',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to create a junta-panelas planning with a date that is not after or equal tomorrow', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => now()->format('Y-m-d'),
        'time' => '14:10',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to create a junta-panelas planning without time', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => null,
    ]);

    $response->assertInvalid('time');
});

test('should fail when trying to create a junta-panelas planning with time in wrong format', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '14:10:58',  // Only accepts hour:minute format
    ]);

    $response->assertInvalid('time');
});
