<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class EscolaValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [

    ];

    protected $messages = [

    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [

            'codigo' => 'required',
            'nome' => 'required',
            'inep' => 'required',
            'portaria' => 'required',
            'dt_pub_portaria' => 'required',

        ],

        ValidatorInterface::RULE_UPDATE => [

            'codigo' => 'required',
            'nome' => 'required',
            'inep' => 'required',
            'portaria' => 'required',
            'dt_pub_portaria' => 'required',

        ],
   ];
}
