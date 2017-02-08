<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DependenciaValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'escola_id' => 'Escola',
        'nome' => 'required|max:100',
        'capacidade' => 'required|max:100',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'integer' => ':attribute deve ser um número interio (combinações 0-9)',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min e :max caracteres',
        'unique' => ':attribute valor já cadastrado'
    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            'escola_id' => 'required|integer',
            'nome' => 'required|max:100',
            'capacidade' => 'required|max:100',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'escola_id' => 'required|integer',
            'nome' => 'required|max:100',
            'capacidade' => 'required|max:100',
        ],
   ];
}
