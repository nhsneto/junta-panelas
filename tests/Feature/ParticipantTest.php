<?php

use App\Models\JuntaPanelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('should add a participant to a junta-panelas', function () {
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
        'time' => '11:30',
    ]);

    $juntaPanelas = JuntaPanelas::first();

    $response = $this->post(route('participant.store', ['juntaPanelas' => $juntaPanelas]), [
        'name' => 'John Doe',
        'item_1' => 'Cake',
    ]);

    $jp = JuntaPanelas::first();

    expect($jp->participants)->not()->toBeEmpty()
        ->and($jp->participants[0]->name)->toBe('John Doe')
        ->and($jp->participants[0]->items[0])->toBe('Cake');

    $response->assertRedirectToRoute('participant.index', ['juntaPanelas' => $jp]);
});

test('should delete a participant from a junta-panelas', function () {
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
        'time' => '11:30',
    ]);

    $juntaPanelas = JuntaPanelas::first();

    $this->post(route('participant.store', ['juntaPanelas' => $juntaPanelas]), [
        'name' => 'John Doe',
        'item_1' => 'Cake',
    ]);

    $jp = JuntaPanelas::first();

    $response = $this->delete(route('participant.destroy', [
        'juntaPanelas' => $jp,
        'participantId' => $jp->participants[0]->id,
    ]));

    $jp = JuntaPanelas::first();

    expect($jp->participants)->toBeEmpty();
    $response->assertRedirectToRoute('participant.index', ['juntaPanelas' => $jp]);
});
