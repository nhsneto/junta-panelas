<?php

return [
    'required' => 'Campo obrigatório.',
    'current_password' => 'Senha incorreta.',
    'email' => 'Email inválido.',

    'custom' => [
        'name' => [
            'min' => [
                'string' => 'Seu nome deve conter pelo menos :min caracteres.',
            ],
            'not_regex' => 'Seu nome deve conter pelo menos uma letra.',
        ],

        'email' => [
            'max' => [
                'string' => 'Seu email é muito longo. Utilize no máximo :max caracteres.'
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
                'string' => 'O título deve conter no máximo :max caracteres.',
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
                'string' => 'O item deve conter no máximo :max caracteres.'
            ],
        ],
        'item_2' => [
            'max' => [
                'string' => 'O item deve conter no máximo :max caracteres.'
            ],
        ],
        'item_3' => [
            'max' => [
                'string' => 'O item deve conter no máximo :max caracteres.'
            ],
        ],
        'item_4' => [
            'max' => [
                'string' => 'O item deve conter no máximo :max caracteres.'
            ],
        ],
        'item_5' => [
            'max' => [
                'string' => 'O item deve conter no máximo :max caracteres.'
            ],
        ],

        'new_email' => [
            'confirmed' => 'Os emails não conferem.',
            'unique' => 'Esse email já existe.',
        ],

        'new_password' => [
            'confirmed' => 'As senhas não conferem.',
            'min' => [
                'string' => 'Sua senha deve conter pelo menos :min caracteres.',
            ],
        ]
    ],
];
