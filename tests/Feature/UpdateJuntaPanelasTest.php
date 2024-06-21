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
