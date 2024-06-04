<?php

return [
    'required' => 'Campo obrigatório.',

    'custom' => [
        'nome' => [
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

        'senha' => [
            'confirmed' => 'As senhas não conferem.',
            'min' => [
                'string' => 'Sua senha deve conter pelo menos :min caracteres.',
            ],
        ]
    ],
];
