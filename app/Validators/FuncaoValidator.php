<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class FuncaoValidator extends LaravelValidator
{
    /**
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * @var array
     */
    protected $messages = [

    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
   ];
}
