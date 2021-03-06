<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PeriodoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'abreviatura' => 'Abreviatura',
        'soma_carga_horaria' => 'Soma Carga Horária',
        'controle_frequencia' => 'Controle de Frequência',
        'ordenacao' => 'Ordenação',
    ];

    protected $messages = [
        'required' => ':attribute é obrigatório',
        'max' => ':attribute deve conter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min e :max caracteres',
        'unique' => ':attribute valor já cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:45',
            'abreviatura' => 'required|max:30',
            'soma_carga_horaria' => 'integer|max:2',
            'controle_frequencia' => 'required|integer|max:2',
            'ordenacao' => 'numeric|digits_between:0,20',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:45',
            'abreviatura' => 'required|max:30',
            'soma_carga_horaria' => 'integer|max:2',
            'controle_frequencia' => 'required|integer|max:2',
            'ordenacao' => 'numeric|digits_between:0,20',
        ],
    ];
}