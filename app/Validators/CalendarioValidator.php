<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CalendarioValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'ano' => 'Ano',
        'data_inicial' => 'Data inicial',
        'data_final' => 'Data final',
        'data_resultado_final' => 'Data de resultafo final',
        'status_id' => 'Status',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];
    
    protected $rules = [
        
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:150',
            'ano' => 'required|max:4',
            'data_inicial' => 'required|max:10',
            'data_final' => 'required|max:10',
            'data_resultado_final' => 'required|max:10',
            'status_id' => 'required',
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:150',
            'ano' => 'required|max:4',
            'data_inicial' => 'required|max:10',
            'data_final' => 'required|max:10',
            'data_resultado_final' => 'required|max:10',
            'status_id' => 'required',
        ],
   ];
}
