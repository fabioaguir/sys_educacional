<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProcedimentoAvaliacaoValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'frequencia_minima_avaliacao' => 'Frequência Mínima'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado',
        'numeric' => ':attribute precisa ser um número'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:100|unique:edu_procedimentos_avaliacoes,nome',
            'codigo' => 'required|max:50|unique:edu_procedimentos_avaliacoes,codigo',
            'frequencia_minima_avaliacao' => 'required|numeric'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:100|unique:edu_procedimentos_avaliacoes,nome,:id',
            'codigo' => 'required|max:50|unique:edu_procedimentos_avaliacoes,codigo,:id',
            'frequencia_minima_avaliacao' => 'required|numeric'
        ],
    ];
}
