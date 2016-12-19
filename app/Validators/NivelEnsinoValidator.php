<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class NivelEnsinoValidator extends LaravelValidator
{

    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'modalidade_id' => 'Modalidade de Ensino'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|serbinario_alpha_space|max:30',
            'codigo' => 'serbinario_alpha_space|max:15',
            'modalidade_id' => 'required|integer'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|serbinario_alpha_space|max:30',
            'codigo' => 'serbinario_alpha_space|max:15',
            'modalidade_id' => 'required|integer'
        ],
   ];
}
