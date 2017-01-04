<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class InstituicaoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;
    
    protected $attributes = [
        'nome' => 'Nome',
        'cnpj' => 'CNPJ',
        'insc_municipal' => 'Inscrição Municípal',
        'insc_estadual' => 'Inscrição Estadual',

        //Tabela Endereço
        'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
        'endereco.numero' => 'required|numeric|digits_between:0,10',
        'endereco.complemento' => 'max:100',
        'endereco.bairro_id' => 'required|integer',
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
            'nome' => 'required|max:100',
            'cnpj' => 'required|max:35',
            'insc_municipal' => 'required|digits_between:0,60',
            'insc_estadual' => 'required|digits_between:0,60',

            //Tabela Endereço
            'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'endereco.numero' => 'required|numeric|digits_between:0,10',
            'endereco.complemento' => 'max:100',
            'endereco.bairro_id' => 'required|integer',
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:100',
            'cnpj' => 'required|max:35',
            'insc_municipal' => 'required|digits_between:0,60',
            'insc_estadual' => 'required|digits_between:0,60',

            //Tabela Endereço
            'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'endereco.numero' => 'required|numeric|digits_between:0,10',
            'endereco.complemento' => 'max:100',
            'endereco.bairro_id' => 'required|integer',
        ],
   ];
}
