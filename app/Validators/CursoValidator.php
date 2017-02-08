<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CursoValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'nivel_ensino_id' => 'Nível de Ensino'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:100',
            'codigo' => 'required|max:50|unique:cursos,codigo',
            'nivel_ensino_id' => 'required'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:100',
            'codigo' => 'required|max:50|unique:cursos,codigo,:id',
            'nivel_ensino_id' => 'required'
        ],
    ];
}
