<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RoleValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'name' => 'Nome',
        'description' => 'Descrição'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:100|unique:roles,name',
            'description' => 'max:100',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:100|unique:roles,name,:id'
        ],
   ];
}
