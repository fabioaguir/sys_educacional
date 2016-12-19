<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CargoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [

    ];

    protected $messages = [

    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [

            'nome' => 'required',
            'codigo' => 'required',
            'cargo_professor' => 'required',

        ],

        ValidatorInterface::RULE_UPDATE => [

            'nome' => 'required',
            'codigo' => 'required',
            'cargo_professor' => 'required',

        ],
   ];
}
