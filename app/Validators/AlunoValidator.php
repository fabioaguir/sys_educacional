<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AlunoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'codigo' => 'Código',
        'num_nis' => 'No. NIS',
        'num_inep' => 'No. INEP',

        //Tabela CGM
        'cgm.nome' => 'Nome',
        'cgm.data_nascimento' => 'Data de Nascimento',
        'cgm.sexo_id' => 'Gênero',
        'cgm.cpf' => 'No. CPF',
        'cgm.rg' => 'No. RG',
        'cgm.pai' => 'Nome do Pai',
        'cgm.mae' => 'Nome da Mãe',
        'cgm.email' => 'Endereço eletrônico',
        'cgm.nacionalidade_id' => 'Nacionalidade',
        'cgm.naturalidade' => 'Naturalidade',

        //Tabela telefone
        'telefone.nome' => 'No. Telefone',

        //Tabela endereco
        'cgm.endereco.logradouro' => 'Logradouro',
        'cgm.endereco.zona_id' => 'Zona',
        'cgm.endereco.numero' => 'Número',
        'cgm.endereco.complemento' => 'Complemento',
        'cgm.endereco.cep' => 'CEP',
        'cgm.endereco.bairro_id' => 'Bairro',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min - :max.',
        'cpf_br' => ':attribute deve ser um número de CPF válido'
    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            //Tabela alunos
            'codigo' => 'numeric|digits_between:0,30',
            'num_nis' => 'required|numeric|digits_between:0,30',
            'num_inep' => 'required|numeric|digits_between:0,30',

            //Tabela CGM
            'cgm.nome' => 'required|serbinario_alpha_space|max:30',
            'cgm.data_nascimento' => '',
            'cgm.sexo_id' => 'integer',
            /*'cgm.cpf' => 'required|cpf_br|digits_between:0,20',
            'cgm.rg' => 'required|numeric|digits_between:0,15',
            'cgm.pai' => 'required|serbinario_alpha_space|max:30',
            'cgm.mae' => 'required|serbinario_alpha_space|max:30',*/
            'cgm.email' => 'email',
            'cgm.nacionalidade_id' => 'integer',
            'cgm.naturalidade' => 'serbinario_alpha_space|max:50',

            //Tabela telefone
            'telefone.nome' => 'required|numeric|digits_between:0,20',

            //Tabela endereco
            'cgm.endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'cgm.endereco.zona_id' => 'integer',
            'cgm.endereco.numero' => 'required|numeric|digits_between:0,8',
            'cgm.endereco.complemento' => 'serbinario_alpha_space|max:150',
            'cgm.endereco.cep' => 'numeric|digits_between:0,12',
            'cgm.endereco.bairro_id' => 'integer',
        ],

        ValidatorInterface::RULE_UPDATE => [
            //Tabela alunos
            'codigo' => 'numeric|digits_between:0,30',
            'num_nis' => 'required|numeric|digits_between:0,30',
            'num_inep' => 'required|numeric|digits_between:0,30',

            //Tabela CGM
            'cgm.nome' => 'required|serbinario_alpha_space|max:30',
            'cgm.data_nascimento' => '',
            'cgm.sexo_id' => 'integer',
            /*'cgm.cpf' => 'required|cpf_br|digits_between:0,20',
            'cgm.rg' => 'required|numeric|digits_between:0,15',
            'cgm.pai' => 'required|serbinario_alpha_space|max:30',
            'cgm.mae' => 'required|serbinario_alpha_space|max:30',*/
            'cgm.email' => 'email',
            'cgm.nacionalidade_id' => 'integer',
            'cgm.naturalidade' => 'serbinario_alpha_space|max:50',

            //Tabela telefone
            'telefone.nome' => 'required|numeric|digits_between:0,20',

            //Tabela endereco
            'cgm.endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'cgm.endereco.zona_id' => 'integer',
            'cgm.endereco.numero' => 'required|numeric|digits_between:0,8',
            'cgm.endereco.complemento' => 'serbinario_alpha_space|max:150',
            'cgm.endereco.cep' => 'numeric|digits_between:0,12',
            'cgm.endereco.bairro_id' => 'integer',
        ],
   ];
}
