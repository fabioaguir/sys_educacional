<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PessoaJuridicaValidator extends LaravelValidator
{
    protected $attributes = [
        'nome' => 'Nome',
        'num_cgm' => 'Número CGM',
        'data_cadastramento' => 'Data de Cadastramento',
        'cnpj' => 'CNPJ',
        'email' => 'E-mail',
        'tipo_empresa_id' => 'Tipo Empresa',
        'nire' => 'Nire',
        'nome_complemento' => 'Nome Complemento',
        'nome_fantasia' => 'Nome Fantasia',
        'inscricao_estadual' => 'Inscrição Estadual',
        'cgm_municipio_id' => 'CGM Município',
        'endereco.logradouro' => 'Logradouro',
        'endereco.numero' => 'Número (em endereço)',
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
            'nome' => 'required|serbinario_alpha_space|max:200',
            //'num_cgm' => 'numeric',
            'data_cadastramento' => 'max:20', //serbinario_date_format
            'cnpj' => 'required|numeric|unique:gen_cgm,cnpj',
            'email' => 'email|max:45',
            'tipo_empresa_id' => 'required|integer',
            'nire' => 'numeric|digits_between:0,45',
            'nome_complemento' => 'required|serbinario_alpha_space|max:45',
            'nome_fantasia' => 'required|serbinario_alpha_space|max:45',
            //'tipo_cadastro' => '',
            'inscricao_estadual' => 'numeric|digits_between:0,45',
            'endereco_id' => 'integer',
            'cgm_municipio_id' => 'required|integer',
            //Endereço
            'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'endereco.numero' => 'required|numeric',
            'endereco.complemento' => 'serbinario_alpha_space|max:120',
            'endereco.cep' => 'numeric',
            'endereco.bairro_id' => 'integer'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|serbinario_alpha_space|max:200',
            //'num_cgm' => 'numeric',
            'data_cadastramento' => 'max:20', //serbinario_date_format
            'cnpj' => 'required|numeric|unique:gen_cgm,cnpj:id',
            'email' => 'email|max:45',
            'tipo_empresa_id' => 'required|integer',
            'nire' => 'numeric|digits_between:0,45',
            'nome_complemento' => 'required|serbinario_alpha_space|max:45',
            'nome_fantasia' => 'required|serbinario_alpha_space|max:45',
            //'tipo_cadastro' => '',
            'inscricao_estadual' => 'numeric|digits_between:0,45',
            'endereco_id' => 'integer',
            'cgm_municipio_id' => 'required|integer',
            //Endereço
            'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'endereco.numero' => 'required|numeric',
            'endereco.complemento' => 'serbinario_alpha_space|max:120',
            'endereco.cep' => 'numeric',
            'endereco.bairro_id' => 'integer'
        ],
   ];
}