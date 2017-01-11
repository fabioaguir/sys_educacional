<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'name' => 'Nome',
        'email' => 'E-mail',
        'password' => 'Senha'
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
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|max:100',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:users,email,:id'
        ],
   ];
}
