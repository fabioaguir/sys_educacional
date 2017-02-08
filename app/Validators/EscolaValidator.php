<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class EscolaValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'codigo' => 'Cógido',
        'nome' => 'Nome',
        'inep' => 'INEP',
        'portaria' => 'Portaria',
        'dt_pub_portaria' => 'Data de Publicação',

        //endereço
        'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
        'endereco.numero' => 'required|numeric|digits_between:0,10',
        'endereco.bairro_id' => 'required|integer'
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min e :max caracteres',
    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            'codigo' => 'required|max:50',
            'nome' => 'required|max:100|serbinario_alpha_space',
            'inep' => 'required|numeric|digits_between:0,20',
            'portaria' => 'required|numeric|digits_between:0,45',
            'dt_pub_portaria' => 'required|max:15',

            //endereço
            'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'endereco.numero' => 'required|numeric|digits_between:0,10',
            'endereco.bairro_id' => 'required|integer'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'codigo' => 'required|max:50',
            'nome' => 'required|max:100|serbinario_alpha_space',
            'inep' => 'required|numeric|digits_between:0,20',
            'portaria' => 'required|numeric|digits_between:0,45',
            'dt_pub_portaria' => 'required|max:15',

            //endereço
            'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'endereco.numero' => 'required|numeric|digits_between:0,10',
            'endereco.bairro_id' => 'required|integer'
        ],
   ];
}