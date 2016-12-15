<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DependenciaValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            
            'escola_id' => 'required',
            'nome' => 'required',
            'capacidade' => 'required',
        ],

        ValidatorInterface::RULE_UPDATE => [

            'escola_id' => 'required',
            'nome' => 'required',
            'capacidade' => 'required',

        ],
   ];
}
