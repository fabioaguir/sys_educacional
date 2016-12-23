<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class FormaAvaliacaoValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'tipo_resultado_id' => 'Tipo de Resultado'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:100|unique:formas_avaliacoes,nome',
            'codigo' => 'required|max:50|unique:formas_avaliacoes,codigo',
            'tipo_resultado_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:100|unique:formas_avaliacoes,nome,:id',
            'codigo' => 'required|max:50|unique:formas_avaliacoes,codigo,:id'
        ],
    ];
}
