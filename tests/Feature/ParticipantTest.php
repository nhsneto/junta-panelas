<?php

use App\Models\JuntaPanelas;
use App\Models\User;

test('should add a participant to a junta-panelas', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
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

test('should fail when trying to add a participant without name to a junta-panelas', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '11:30',
    ]);

    $jp = JuntaPanelas::first();

    $response = $this->post(route('participant.store', ['juntaPanelas' => $jp]), [
        'name' => null,
        'item_1' => 'Cake',
    ]);

    $response->assertInvalid('name');
});

test('should fail when trying to add a participant whose name is longer than 100 characters to a junta-panelas', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '11:30',
    ]);

    $jp = JuntaPanelas::first();

    $response = $this->post(route('participant.store', ['juntaPanelas' => $jp]), [
        'name' => 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test T',
        'item_1' => 'Cake',
    ]);

    $response->assertInvalid('name');
});

test('should fail when trying to add a participant without any item to a junta-panelas', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '11:30',
    ]);

    $jp = JuntaPanelas::first();

    $response = $this->post(route('participant.store', ['juntaPanelas' => $jp]), [
        'name' => 'Test name',
        'item_1' => null,
        'item_2' => null,
        'item_3' => null,
        'item_4' => null,
        'item_5' => null,
    ]);

    $response->assertInvalid('item_1'); // The 'item_1' field is the chosen to get the error message about participant with no items
});

test('should fail when trying to add a participant with an item longer than 100 characters', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '11:30',
    ]);

    $jp = JuntaPanelas::first();

    $response = $this->post(route('participant.store', ['juntaPanelas' => $jp]), [
        'name' => 'Test name',
        'item_1' => null,
        'item_2' => 'Soda',
        'item_3' => null,
        'item_4' => 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test T',
        'item_5' => null,
    ]);

    $response->assertInvalid('item_4');
});

test('should delete a participant from a junta-panelas', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('junta-panelas.store'), [
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
