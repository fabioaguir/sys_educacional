<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CurriculoValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'curso_id' => 'required',
            'nome' => 'required',
            'codigo' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'curso_id' => 'required',
            'nome' => 'required',
            'codigo' => 'required'
        ],
   ];
}
