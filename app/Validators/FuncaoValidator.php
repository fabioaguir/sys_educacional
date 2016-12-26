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
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'digits_between' => ':attribute deve ter entre :min e :max caracteres',
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|serbinario_alpha_space|digits_between:0,60',
            'sigla' => 'serbinario_alpha_space|digits_between:0,20',
            'funcao_professor' => 'integer'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|serbinario_alpha_space|digits_between:0,60',
            'sigla' => 'serbinario_alpha_space|digits_between:0,20',
            'funcao_professor' => 'integer'
        ],
   ];
}
