<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ModalidadeEnsinoValidator extends LaravelValidator
{
    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'unique' => ':attribute já existe'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|serbinario_alpha_space|max:30|unique:modalidades,nome',
            'codigo' => 'required|max:15|unique:modalidades,codigo'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|serbinario_alpha_space|max:30|unique:modalidades,nome',
            'codigo' => 'required|max:15|unique:modalidades,codigo'
        ],
   ];
}