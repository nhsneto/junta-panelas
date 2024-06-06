<?php

test('home page can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('registration page can be rendered', function () {
    $response = $this->get('/cadastro');

    $response->assertStatus(200);
});

test('login page can be rendered', function () {
    $response = $this->get('/entrar');

    $response->assertStatus(200);
});
