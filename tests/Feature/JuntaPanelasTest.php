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
        'time' => '05:30',
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
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '09:45',
    ]);

    $juntaPanelas = JuntaPanelas::first();
    $former_updated_at = $juntaPanelas->updated_at; // Should be modified after the put request
    $newTitle = 'New test title';
    $newDate = now()->modify('+ 2 days')->format('Y-m-d');
    $newTime = '10:30';

    $response = $this->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => $newTitle,
        'date' => $newDate,
        'time' => $newTime,
    ]);

    $jp = JuntaPanelas::first();
    $iso8601Date = date('c', strtotime($newDate . $newTime));

    expect($jp->title)->toBe($newTitle)
        ->and($jp->date)->toBe($iso8601Date)
        ->and($jp->updated_at)->not()->toEqual($former_updated_at);

    $response->assertRedirectToRoute('junta-panelas.edit', [
        'juntaPanelas' => $juntaPanelas,
    ]);
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
    $date = now()->addDay()->format('Y-m-d');
    $time = '08:20';

    $this->post(route('junta-panelas.store'), [
        'title' => $title,
        'date' => $date,
        'time' => $time,
    ]);

    $juntaPanelas = JuntaPanelas::first();
    $former_updated_at = $juntaPanelas->updated_at; // Should be the same after the put request in this case

    $response = $this->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => $title,
        'date' => $date,
        'time' => $time,
    ]);

    $jp = JuntaPanelas::first();
    $iso8601Date = date('c', strtotime($date . $time));

    expect($jp->title)->toBe($title)
        ->and($jp->date)->toBe($iso8601Date)
        ->and($jp->updated_at)->toEqual($former_updated_at);

    $response->assertRedirectToRoute('junta-panelas.edit', [
        'juntaPanelas' => $juntaPanelas,
    ]);
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
        'date' => now()->addDay()->format('Y-m-d'),
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
        'date' => now()->addDay()->format('Y-m-d'),
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
        'date' => now()->addDay()->format('Y-m-d'),
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

test('should fail when trying to update a junta-panelas planning with a date that is not after or equal tomorrow', function () {
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
        'time' => '08:20',
    ]);

    $id = JuntaPanelas::first()->id;

    $response = $this->put("junta-panelas/{$id}", [
        'title' => 'Test title',
        'date' => now()->format('Y-m-d'),
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
        'date' => now()->addDay()->format('Y-m-d'),
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
        'date' => now()->addDay()->format('Y-m-d'),
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

test('should delete junta-panelas planning', function () {
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
        'time' => '22:50',
    ]);

    $id = JuntaPanelas::where('title', 'Test title')->first()->id;

    $response = $this->delete(route('junta-panelas.destroy', [
        'juntaPanelas' => $id,
    ]));

    $jp = JuntaPanelas::find($id);

    expect($jp)->toBeNull();
    $response->assertRedirectToRoute('junta-panelas.index');
});

test('should generate and download a junta-panelas pdf', function () {
    User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $name = 'Test title';

    $this->post(route('junta-panelas.store'), [
        'title' => $name,
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '11:30',
    ]);

    $jp = JuntaPanelas::first();

    $response = $this->get(route('junta-panelas.pdf', [
        'juntaPanelas' => $jp,
    ]));

    $response->assertDownload("{$name}.pdf");
});
