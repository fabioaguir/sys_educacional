<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class FuncaoValidator extends LaravelValidator
{

    protected $attributes = [
        'nome' => 'Nome',
        'sigla' => 'Sigla',
        'funcao_professor' => " 'Função professor?' "
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|serbinario_alpha_space',
            'sigla' => 'serbinario_alpha_space',
            'funcao_professor' => 'integer'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|serbinario_alpha_space',
            'sigla' => 'serbinario_alpha_space',
            'funcao_professor' => 'integer'
        ],
   ];
}
