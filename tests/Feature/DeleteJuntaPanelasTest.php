<?php

use App\Models\JuntaPanelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
