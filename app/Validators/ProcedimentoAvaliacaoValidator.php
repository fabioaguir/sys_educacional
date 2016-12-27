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
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:100|unique:procedimentos_avaliacoes,nome',
            'codigo' => 'required|max:50|unique:procedimentos_avaliacoes,codigo',
            'frequencia_minima_avaliacao' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:100|unique:procedimentos_avaliacoes,nome,:id',
            'codigo' => 'required|max:50|unique:procedimentos_avaliacoes,codigo,:id',
            'frequencia_minima_avaliacao' => 'required'
        ],
    ];
}
