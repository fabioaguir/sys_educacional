<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AlocacaoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [

    ];

    protected $messages = [

    ];
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
