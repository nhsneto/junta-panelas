<?php

use App\Models\JuntaPanelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should update a junta-panelas planning', function () {
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
        'date' => date('Y-m-d'),
        'time' => '09:45',
    ]);

    $juntaPanelas = JuntaPanelas::first();
    $id = $juntaPanelas->id;
    $former_updated_at = $juntaPanelas->updated_at; // Should be modified after the put request
    $newTitle = 'New test title';
    $newDate = now()->modify('+ 1 day')->format('Y-m-d');
    $newTime = '10:30';

    $response = $this->put("junta-panelas/{$id}", [
        'title' => $newTitle,
        'date' => $newDate,
        'time' => $newTime,
    ]);

    $jp = JuntaPanelas::find($id);
    $iso8601Date = date('c', strtotime($newDate . $newTime));

    expect($jp->title)->toBe($newTitle)
        ->and($jp->date)->toBe($iso8601Date)
        ->and($jp->updated_at)->not()->toEqual($former_updated_at);

    $response->assertRedirectToRoute('junta-panelas.edit');
});

test('should do nothing when trying to update a junta-panelas planning with no new data', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $title = 'Test title';
    $date = date('Y-m-d');
    $time = '08:20';

    $this->post(route('junta-panelas.store'), [
        'title' => $title,
        'date' => $date,
        'time' => $time,
    ]);

    $juntaPanelas = JuntaPanelas::first();
    $id = $juntaPanelas->id;
    $former_updated_at = $juntaPanelas->updated_at; // Should be the same after the put request in this case

    $response = $this->put("junta-panelas/{$id}", [
        'title' => $title,
        'date' => $date,
        'time' => $time,
    ]);

    $jp = JuntaPanelas::find($id);
    $iso8601Date = date('c', strtotime($date . $time));

    expect($jp->title)->toBe($title)
        ->and($jp->date)->toBe($iso8601Date)
        ->and($jp->updated_at)->toEqual($former_updated_at);

    $response->assertRedirectToRoute('junta-panelas.edit');
});

test('should fail when trying to update a junta-panelas planning without title', function () {
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
        'date' => date('Y-m-d'),
        'time' => '08:20',
    ]);

    $id = JuntaPanelas::first()->id;

    $response = $this->put("junta-panelas/{$id}", [
        'title' => null,
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => '16:00',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to update a junta-panelas planning whose title has more than 255 characters', function () {
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
        'date' => date('Y-m-d'),
        'time' => '08:20',
    ]);

    $id = JuntaPanelas::first()->id;

    $response = $this->put("junta-panelas/{$id}", [
        'title' => 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test T',
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => '16:00',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to update a junta-panelas planning with no date', function () {
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
        'date' => date('Y-m-d'),
        'time' => '08:20',
    ]);

    $id = JuntaPanelas::first()->id;

    $response = $this->put("junta-panelas/{$id}", [
        'title' => 'Test title',
        'date' => null,
        'time' => '16:00',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to update a junta-panelas planning with a date that already passed', function () {
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
        'date' => date('Y-m-d'),
        'time' => '08:20',
    ]);

    $id = JuntaPanelas::first()->id;

    $response = $this->put("junta-panelas/{$id}", [
        'title' => 'Test title',
        'date' => now()->subDay()->format('Y-m-d'),
        'time' => '16:00',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to update a junta-panelas planning without time', function () {
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
        'date' => date('Y-m-d'),
        'time' => '08:20',
    ]);

    $id = JuntaPanelas::first()->id;

    $response = $this->put("junta-panelas/{$id}", [
        'title' => 'Test title',
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => null,
    ]);

    $response->assertInvalid('time');
});

test('should fail when trying to update a junta-panelas planning with time in wrong format', function () {
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
        'date' => date('Y-m-d'),
        'time' => '08:20',
    ]);

    $id = JuntaPanelas::first()->id;

    $response = $this->put("junta-panelas/{$id}", [
        'title' => 'Test title',
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => '06:15:20', // Only accepts time in HH:MM format
    ]);

    $response->assertInvalid('time');
});
