<?php

use App\Models\JuntaPanelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('home page can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('registration page can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

test('login page can be rendered', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

test('junta-panelas index page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('junta-panelas.index'));

    $response->assertStatus(200);
});

test('junta-panelas create page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('junta-panelas.create'));

    $response->assertStatus(200);
});

test('junta-panelas edit page can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '08:30',
    ]);

    $response = $this->actingAs($user)->get(route('junta-panelas.edit', [
        'juntaPanelas' => JuntaPanelas::first(),
    ]));

    $response->assertStatus(200);
});

test('junta-panelas profile page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('profile'));

    $response->assertStatus(200);
});

test('junta-panelas participants page can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '07:00',
    ]);

    $response = $this->actingAs($user)->get(route('participant.index', [
        'juntaPanelas' => JuntaPanelas::first(),
    ]));

    $response->assertStatus(200);
});

test('junta-panelas show page can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '12:40',
    ]);

    $response = $this->actingAs($user)->get(route('junta-panelas.show', [
        'juntaPanelas' => JuntaPanelas::first(),
    ]));

    $response->assertStatus(200);
});
