<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PeriodoAvaliacaoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'data_inicial' => 'Data Inicial',
        'data_final' => 'Data Final',
        'dias_letivos' => 'Dias Letivos',
        'semanas_letivas' => 'Semanas Letivas',
        'total_dias_letivos' => 'Total de Dias Letivos',
        'total_semanas_letivas' => 'Total de Semanas Letivas',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
    ];
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'data_inicial' => 'required|max:15',
            'data_final' => 'required|max:15',
            'dias_letivos' => 'required|max:15|integer',
            'semanas_letivas' => 'required|max:15|integer',
            'total_dias_letivos' => 'required|max:15|integer',
            'total_semanas_letivas' => 'required|max:15|integer',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'data_inicial' => 'required|max:15',
            'data_final' => 'required|max:15',
            'dias_letivos' => 'required|max:15|integer',
            'semanas_letivas' => 'required|max:15|integer',
            'total_dias_letivos' => 'required|max:15|integer',
            'total_semanas_letivas' => 'required|max:15|integer',
        ],
   ];
}