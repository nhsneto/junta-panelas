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
            'after' => 'Escolha uma data a partir de amanhã (' . now()->addDay()->format('d/m/Y') . ').',
        ],

        'time' => [
            'date_format' => 'A hora deve estar no formato HH:MM.',
        ],

        'item_1' => [
            'max' => [
                'string' => 'O item deve conter no máximo 100 caracteres.'
            ],
        ],
        'item_2' => [
            'max' => [
                'string' => 'O item deve conter no máximo 100 caracteres.'
            ],
        ],
        'item_3' => [
            'max' => [
                'string' => 'O item deve conter no máximo 100 caracteres.'
            ],
        ],
        'item_4' => [
            'max' => [
                'string' => 'O item deve conter no máximo 100 caracteres.'
            ],
        ],
        'item_5' => [
            'max' => [
                'string' => 'O item deve conter no máximo 100 caracteres.'
            ],
        ],
    ],
];
