<?php

use App\Models\JuntaPanelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
