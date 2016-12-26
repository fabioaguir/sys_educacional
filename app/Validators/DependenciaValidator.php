<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DependenciaValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [

    ];

    protected $messages = [

    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            
            'escola_id' => 'required',
            'nome' => 'required|max:100',
            'capacidade' => 'required|max:100',
        ],

        ValidatorInterface::RULE_UPDATE => [

            'escola_id' => 'required',
            'nome' => 'required|max:100',
            'capacidade' => 'required|max:100',

        ],
   ];
}
