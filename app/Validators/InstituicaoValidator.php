<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class InstituicaoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;
    
    protected $attributes = [

    ];

    protected $messages = [

    ];
    
    protected $rules = [
        
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required',
            'cnpj' => 'required',
            'insc_municipal' => 'required',
            'insc_estadual' => 'required',

            //Tabela Endereço
            'endereco.logradouro' => 'required',
            'endereco.numero' => 'required|max:99999',
            'endereco.complemento' => 'max:100',
            'endereco.bairro_id' => 'required|integer',
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            
            'nome' => 'required',
            'cnpj' => 'required',
            'insc_municipal' => 'required',
            'insc_estadual' => 'required',
            
            
            //Tabela Endereço
            'endereco.logradouro' => 'required',
            'endereco.numero' => 'required|max:99999',
            'endereco.complemento' => 'max:100',
            'endereco.bairro_id' => 'required|integer',
            
        ],
   ];
}
