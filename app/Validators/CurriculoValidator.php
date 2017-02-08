<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CurriculoValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'observacao' => 'Observação',
        'curso_id' => 'Curso',
        'serie_inicial_id' => 'Série Inicial',
        'serie_final_id' => 'Série Final'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:100',
            'codigo' => 'required|max:50|unique:curriculos,codigo',
            'curso_id' => 'integer|required',
            'observacao' => 'max:500',
            'serie_inicial_id' => 'integer|required',
            'serie_final_id' => 'integer|required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:100',
            'codigo' => 'required|max:50|unique:curriculos,codigo,:id',
            'curso_id' => 'integer|required',
            'observacao' => 'max:500',
            'serie_inicial_id' => 'integer|required',
            'serie_final_id' => 'integer|required'
        ],
    ];
}
