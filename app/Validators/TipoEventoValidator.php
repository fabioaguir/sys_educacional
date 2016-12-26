<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TipoEventoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [

    ];

    protected $messages = [

    ];
    
    protected $rules = [
        
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:250',
            'abreviatura' => 'required|max:45'
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:250',
            'abreviatura' => 'required|max:45'
        ],
   ];
}
