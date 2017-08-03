<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ParecerValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:100|unique:edu_pareceres,nome',
            'codigo' => 'required|max:50|unique:edu_pareceres,codigo'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:100|unique:edu_pareceres,nome,:id',
            'codigo' => 'required|max:50|unique:edu_pareceres,codigo,:id'
        ],
   ];
}
