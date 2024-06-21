<?php

return [
    'required' => 'Campo obrigatório.',

    'custom' => [
        'name' => [
            'min' => [
                'string' => 'Seu nome deve conter pelo menos :min caracteres.',
            ],
            'not_regex' => 'Seu nome deve conter pelo menos uma letra.',
        ],

        'email' => [
            'email' => 'Email inválido.',
            'max' => [
                'string' => 'Seu email é muito longo.'
            ],
            'unique' => 'Esse email já existe.'
        ],

        'password' => [
            'confirmed' => 'As senhas não conferem.',
            'min' => [
                'string' => 'Sua senha deve conter pelo menos :min caracteres.',
            ],
        ],

        'title' => [
            'max' => [
                'string' => 'O título deve conter no máximo 255 caracteres.',
            ],
        ],

        'date' => [
            'after_or_equal' => 'A data não pode ser no passado. Escolha uma data a partir de hoje (' . date('d/m/Y') . ').',
        ],

        'time' => [
            'date_format' => 'A hora deve estar no formato HH:MM.',
        ],
    ],
];
