<?php

use App\Models\JuntaPanelas;
use App\Models\User;

test('should create a junta-panelas planning', function () {
    $user = User::factory()->create();
    $title = 'John doe party';
    $date = now()->addDay()->format('Y-m-d');
    $time = '14:10';

    $response = $this->actingAs($user)->post(route('junta-panelas.store'), [
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
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => null,
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '05:30',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to create a junta-panelas planning whose title has more than 255 characters', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test T',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '14:10',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to create a junta-panelas planning with no date', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => null,
        'time' => '14:10',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to create a junta-panelas planning with a date that is not after or equal tomorrow', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => now()->format('Y-m-d'),
        'time' => '14:10',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to create a junta-panelas planning without time', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => null,
    ]);

    $response->assertInvalid('time');
});

test('should fail when trying to create a junta-panelas planning with time in wrong format', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('junta-panelas.store'), [
        'title' => 'Christmas Party',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '14:10:58',  // Only accepts hour:minute format
    ]);

    $response->assertInvalid('time');
});

test('should update a junta-panelas planning', function () {
    $juntaPanelas = JuntaPanelas::factory()->create();

    $former_updated_at = $juntaPanelas->updated_at; // Should be modified after the put request
    $newTitle = 'New test title';
    $newDate = now()->modify('+ 2 days')->format('Y-m-d');
    $newTime = '10:30';

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
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
    $title = 'Test title';
    $date = now()->addDay()->format('Y-m-d');
    $time = '08:20';
    $iso8601Date = date('c', strtotime($date . $time));

    $juntaPanelas = JuntaPanelas::factory()->create([
        'title' => $title,
        'date' => $iso8601Date,
    ]);

    $former_updated_at = $juntaPanelas->updated_at; // Should be the same after the put request in this case

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => $title,
        'date' => $date,
        'time' => $time,
    ]);

    $jp = JuntaPanelas::first();

    expect($jp->title)->toBe($title)
        ->and($jp->date)->toBe($iso8601Date)
        ->and($jp->updated_at)->toEqual($former_updated_at);

    $response->assertRedirectToRoute('junta-panelas.edit', [
        'juntaPanelas' => $juntaPanelas,
    ]);
});

test('should fail when trying to update a junta-panelas planning without title', function () {
    $juntaPanelas = JuntaPanelas::factory()->create();

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => null,
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => '16:00',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to update a junta-panelas planning whose title has more than 255 characters', function () {
    $juntaPanelas = JuntaPanelas::factory()->create();

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test T',
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => '16:00',
    ]);

    $response->assertInvalid('title');
});

test('should fail when trying to update a junta-panelas planning with no date', function () {
    $juntaPanelas = JuntaPanelas::factory()->create();

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => 'Test title',
        'date' => null,
        'time' => '16:00',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to update a junta-panelas planning with a date that is not after or equal tomorrow', function () {
    $juntaPanelas = JuntaPanelas::factory()->create();

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => 'Test title',
        'date' => now()->format('Y-m-d'),
        'time' => '16:00',
    ]);

    $response->assertInvalid('date');
});

test('should fail when trying to update a junta-panelas planning without time', function () {
    $juntaPanelas = JuntaPanelas::factory()->create();

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => 'Test title',
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => null,
    ]);

    $response->assertInvalid('time');
});

test('should fail when trying to update a junta-panelas planning with time in wrong format', function () {
    $juntaPanelas = JuntaPanelas::factory()->create();

    $response = $this->actingAs($juntaPanelas->user)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => 'Test title',
        'date' => now()->modify('+ 1 day')->format('Y-m-d'),
        'time' => '06:15:20', // Only accepts time in HH:MM format
    ]);

    $response->assertInvalid('time');
});

test('should delete junta-panelas planning', function () {
    $juntaPanelas = JuntaPanelas::factory()->create([
        'title' => 'Test title',
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '22:50',
    ]);

    $response = $this->actingAs($juntaPanelas->user)->delete(route('junta-panelas.destroy', [
        'juntaPanelas' => $juntaPanelas,
    ]));

    $jp = JuntaPanelas::all();

    expect($jp)->toBeEmpty();
    $response->assertRedirectToRoute('junta-panelas.index');
});

test('should generate and download a junta-panelas pdf', function () {
    $title = 'Test title';

    $juntaPanelas = JuntaPanelas::factory()->create([
        'title' => $title,
    ]);

    $response = $this->actingAs($juntaPanelas->user)->get(route('junta-panelas.pdf', [
        'juntaPanelas' => $juntaPanelas,
    ]));

    $response->assertDownload("{$title}.pdf");
});

test('should fail when trying to update a junta-panelas planning as a user that doesn\'t own it', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $juntaPanelas = JuntaPanelas::factory()->create([
        'user_id' => $user,
    ]);

    $response = $this->actingAs($otherUser)->put(route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]), [
        'title' => 'New Test title',
        'date' => now()->modify('+ 5 days')->format('Y-m-d'),
        'time' => '20:00',
    ]);

    $response->assertStatus(403);
});

test('should fail when trying to delete a junta-panelas planning as a user that doesn\'t own it', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $juntaPanelas = JuntaPanelas::factory()->create([
        'user_id' => $user,
    ]);

    $response = $this->actingAs($otherUser)->delete(route('junta-panelas.destroy', [
        'juntaPanelas' => $juntaPanelas,
    ]));

    $response->assertStatus(403);
});
