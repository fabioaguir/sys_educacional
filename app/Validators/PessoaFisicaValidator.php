<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PessoaFisicaValidator extends LaravelValidator
{

    protected $attributes = [
        'estado_civil_id' => 'Estado Civil',
        'sexo_id' => 'Sexo',
        'nacionalidade_id' => 'Nacionalidade',
        'cgm_municipio_id' => 'CGM Município',
        'escolaridade_id' => 'Escolaridade',
        'cpf' => 'CPF',
        'rg' => 'RG',
        'orgao_emissor' => 'Orgão Emissor',
        'nome' => 'Nome',
        'pai' => 'Nome Pai',
        'mae' => 'Nome Mãe',
        'naturalidade' => 'Naturalidade',
        'inscricao_estadual' => 'Inscrição Estadual',
        'data_nascimento' => 'Data de Nascimento',
        'data_falecimento' => 'Data de Falecimento',
        'data_expedicao' => 'Data de Expedição',
        'data_vencimento_cnh' => 'Data de Vencimento (CNH)',
        'email' => 'E-mail',
        'num_cnh' => 'Número da CNH',
        'cnh_categoria_id' => 'Categoria (CNH)',
        'endereco.logradouro' => 'Logradouro',
        'endereco.numero' => 'Número (em endereço)',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'estado_civil_id' => 'integer',
            'sexo_id' => 'required|integer',
            'nacionalidade_id' => 'integer|required',
            'cgm_municipio_id' => 'integer|required',
            'escolaridade_id' => 'integer|required',
            'endereco_id' => 'integer',
            //'num_cgm' => 'number',
            'cpf' => 'required|cpf_br',
            'rg' => 'required|numeric',
            'orgao_emissor' => 'serbinario_alpha_space|max:30',
            'nome' => 'required|serbinario_alpha_space|max:200',
            'pai' => 'required|serbinario_alpha_space|max:200',
            'mae' => 'required|serbinario_alpha_space|max:200',
            'naturalidade' => 'serbinario_alpha_space|max:80',
            'inscricao_estadual' => 'numeric',
            'data_nascimento' => 'required', //|serbinario_date_format
            'data_falecimento' => '', //|serbinario_date_format
            'data_expedicao' => 'required', //|serbinario_date_format
            //'data_cadastramento',
            'data_vencimento_cnh' => '', //|serbinario_date_format
            'email' => 'email|max:90',
            'num_cnh' => 'numeric',
            'cnh_categoria_id' => 'integer',
            //Endereço
            'endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'endereco.numero' => 'required|numeric',
            'endereco.complemento' => 'serbinario_alpha_space|max:120',
            'endereco.cep' => 'numeric',
            'endereco.bairro_id' => 'integer'
        ],

        ValidatorInterface::RULE_UPDATE => [
            'estado_civil_id' => 'integer',
            'sexo_id' => 'required|integer',
            'nacionalidade_id' => 'integer|required',
            'cgm_municipio_id' => 'integer|required',
            'escolaridade_id' => 'integer|required',
            'endereco_id' => 'integer',
            //'num_cgm' => 'number',
            'cpf' => 'required|cpf_br',
            'rg' => 'required|numeric',
            'orgao_emissor' => 'serbinario_alpha_space|max:30',
            'nome' => 'required|serbinario_alpha_space|max:200',
            'pai' => 'required|serbinario_alpha_space|max:200',
            'mae' => 'required|serbinario_alpha_space|max:200',
            'naturalidade' => 'serbinario_alpha_space|max:80',
            'inscricao_estadual' => 'numeric',
            'data_nascimento' => 'required', //|serbinario_date_format
            'data_falecimento' => '', //|serbinario_date_format
            'data_expedicao' => 'required', //|serbinario_date_format
            //'data_cadastramento',
            'data_vencimento_cnh' => '', //|serbinario_date_format
            'email' => 'email|max:90',
            'num_cnh' => 'numeric',
            'cnh_categoria_id' => 'integer',
        ],
   ];
}
