<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TipoEventoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'abreviatura' => 'Abreviatura',

    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min e :max caracteres',
    ];
    
    protected $rules = [
        
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|serbinario_alpha_space|max:250',
            'abreviatura' => 'required|serbinario_alpha_space|max:45'
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|serbinario_alpha_space|max:250',
            'abreviatura' => 'required|serbinario_alpha_space|max:45'
        ],
   ];
}
