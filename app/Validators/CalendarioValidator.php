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
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min e :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];
    
    protected $rules = [
        
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|serbinario_alpha_space|max:150',
            'ano' => 'required|max:4', //serbinario_alpha_space
            'data_inicial' => 'required|max:10', //serbinario_alpha_space
            'data_final' => 'required|max:10', //serbinario_alpha_space
            'data_resultado_final' => 'required|max:10', //serbinario_alpha_space
            'status_id' => 'required',
            'duracoes_id' => 'integer|required',
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|serbinario_alpha_space|max:150',
            'ano' => 'required|max:4', //serbinario_alpha_space
            'data_inicial' => 'required|max:10', //serbinario_alpha_space
            'data_final' => 'required|max:10', //serbinario_alpha_space
            'data_resultado_final' => 'required|max:10', //serbinario_alpha_space
            'status_id' => 'required',
            'duracoes_id' => 'integer|required',
        ],
   ];
}
