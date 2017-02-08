<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use \SerEducacional\Uteis\SerbinarioSenhaAtual;

class UserAlterarSenhaValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'senha_atual' => 'Senha Atual',
        'password' => 'Nova Senha',
        'password_confirmation' => 'Confirmação de Senha',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'digits_between' => ':attribute deve ter entre :min - :max.',
        'unique' => ':attribute já se encontra cadastrado',
        'confirmed' => 'O campo Confirmação de Senha precisar ser igual ao campo :attribute',
        'SerbinarioSenhaAtual' => 'teste'
    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            /*'senha_atual' => 'Senha Atual',
            'nova_senha' => 'Nova Senha',
            'confirmacao_senha' => 'Confirmação de Senha',*/
        ],

        ValidatorInterface::RULE_UPDATE => [
            'senha_atual' => 'required', //exists:users,password
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ],
    ];
}
