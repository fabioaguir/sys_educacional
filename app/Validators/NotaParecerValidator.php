<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class NotaParecerValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'parecer' => '',
        'aluno_id' => '',
        'turma_id' => '',
        'periodo_id' => '',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'parecer' => '',
            'aluno_id' => '',
            'turma_id' => '',
            'periodo_id' => '',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'parecer' => '',
            'aluno_id' => '',
            'turma_id' => '',
            'periodo_id' => '',
        ],
   ];
}
