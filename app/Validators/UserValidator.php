<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'email' => 'E-mail',
        'password' => 'Senha'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'email' => 'required|max:100|unique:users,email',
            'password' => 'required|max:100',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'email' => 'required|max:100|unique:users,email,:id'
        ],
   ];
}
