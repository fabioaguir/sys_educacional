<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class FormacaoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'tipo_resultado_id' => 'Tipo de Resultado',
        'menor_nota' => 'Menor Nota',
        'maior_nota' => 'Maior Nota',
        'variacao' => 'Variação',
        'minimo_aprovacao' => 'Minímo Aprovação',
        //'niveis_alfabeizacao' => '',
        'codigo_nivel_alfabetizacao' => 'Código do Nível de Alfabetização',
        'nome_nivel_alfabetizacao' => 'Nome Nível de Alfabetização',
        'min_aprovacao_nivel_alfabetizacao' => 'Minímo Nível de Alfabetização',
        'parecer' => 'Parecer',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min - :max.',
        'cpf_br' => ':attribute deve ser um número de CPF válido',
        'unique' => ':attribute já se encontra cadastrado'
    ];
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max: 100',
            'codigo' => 'required|max: 100',
            'tipo_resultado_id' => 'required|integer',
            'menor_nota' => 'numeric|digits_between:0,5',
            'maior_nota' => 'numeric|digits_between:0,5',
            'variacao' => 'numeric|digits_between:0,5',
            'minimo_aprovacao' => 'integer',
            //'niveis_alfabeizacao' => '',
            'codigo_nivel_alfabetizacao' => '',
            'nome_nivel_alfabetizacao' => 'integer',
            'min_aprovacao_nivel_alfabetizacao' => 'integer',
            'parecer' => 'integer',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max: 100',
            'codigo' => 'required|max: 100',
            'tipo_resultado_id' => 'integer',
            'menor_nota' => 'numeric|digits_between:0,5',
            'maior_nota' => 'numeric|digits_between:0,5',
            'variacao' => 'numeric|digits_between:0,5',
            'minimo_aprovacao' => 'integer',
            //'niveis_alfabeizacao' => '',
            'codigo_nivel_alfabetizacao' => '',
            'nome_nivel_alfabetizacao' => 'integer',
            'min_aprovacao_nivel_alfabetizacao' => 'integer',
            'parecer' => 'integer',
        ],
   ];
}