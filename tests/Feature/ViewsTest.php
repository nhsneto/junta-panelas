<?php

test('home page can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('registration page can be rendered', function () {
    $response = $this->get('/cadastro');

    $response->assertStatus(200);
});
