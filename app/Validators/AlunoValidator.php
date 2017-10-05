<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AlunoValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'codigo' => 'Código',
        'num_inep' => 'No. INEP',
        'nome_cartorio_rg_civil' => 'Nome do cartório do registro civil',
        'num_registro_nascimento' => 'Número do registro de nascimento',
        'livro' => 'Livro',
        'folha' => 'Folha',
        'cidade_certidao' => 'Cidade da certidão',
        'data_emissao' => 'Data de emissão',
        'profissao_pai' => 'Profissão do pai',
        'profissao_mae' => 'Profissão da mãe',
        'necessidade_especial_id' => 'Necessidade especial',
        'transporte_escolar_id' => 'Transporte escolar',

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
        'cgm.numero_nis' => 'No. NIS',

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
        'cpf_br' => ':attribute deve ser um número de CPF válido',
        'unique' => ':attribute já se encontra cadastrado'
    ];

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            //Tabela alunos
           // 'codigo' => 'required|numeric|digits_between:0,45',
          //  'num_inep' => 'required|numeric|digits_between:0,30',
            'nome_cartorio_rg_civil' => 'required',
            'num_registro_nascimento' => 'required',
            'livro' => 'required',
            'folha' => 'required',
            'cidade_certidao' => 'required',
            'data_emissao' => 'required',
            'profissao_pai' => 'required',
            'profissao_mae' => 'required',
            'necessidade_especial_id' => 'required',
            'transporte_escolar_id' => 'required',

            //Tabela CGM
            'cgm.nome' => 'required|serbinario_alpha_space|max:45',
          //  'cgm.data_nascimento' => 'max:15', //date_br
         //   'cgm.sexo_id' => 'required|integer',
            //'cgm.cpf' => 'cpf_br|digits_between:0,15|unique:cgm,cpf',
         //   'cgm.rg' => 'numeric|digits_between:0,20',
         //   'cgm.pai' => 'serbinario_alpha_space|max:45',
            'cgm.mae' => 'serbinario_alpha_space|max:250',
        //    'cgm.email' => 'email|max:45',
        //    'cgm.nacionalidade_id' => 'integer',
         //   'cgm.naturalidade' => 'required|serbinario_alpha_space|max:45',
        //    'cgm.numero_nis' => 'required|numeric|digits_between:0,30',

            //Tabela telefone
            'telefone.nome' => 'required|numeric|digits_between:0,20',

            //Tabela endereco
          //  'cgm.endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
          //  'cgm.endereco.zona_id' => 'integer',
        //    'cgm.endereco.numero' => 'required|numeric|digits_between:0,8',
        //    'cgm.endereco.complemento' => 'serbinario_alpha_space|max:150',
        //    'cgm.endereco.cep' => 'numeric|digits_between:0,12',
        //    'cgm.endereco.bairro_id' => 'integer',
        ],

        ValidatorInterface::RULE_UPDATE => [
            //Tabela alunos
           // 'codigo' => 'required|numeric|digits_between:0,45',
          //  'num_inep' => 'required|numeric|digits_between:0,30',
            'nome_cartorio_rg_civil' => 'required',
            'num_registro_nascimento' => 'required',
            'livro' => 'required',
            'folha' => 'required',
            'cidade_certidao' => 'required',
            'data_emissao' => 'required',
            'profissao_pai' => 'required',
            'profissao_mae' => 'required',
            'necessidade_especial_id' => 'required',
            'transporte_escolar_id' => 'required',

            //Tabela CGM
            'cgm.nome' => 'required|serbinario_alpha_space|max:45',
         //   'cgm.data_nascimento' => 'max:15', //date_br
         //   'cgm.sexo_id' => 'required|integer',
            //'cgm.cpf' => 'cpf_br|digits_between:0,15|unique:gen_cgm,cpf,:id',
         //   'cgm.rg' => 'numeric|digits_between:0,20',
         //   'cgm.pai' => 'serbinario_alpha_space|max:45',
            'cgm.mae' => 'serbinario_alpha_space|max:45',
         //   'cgm.email' => 'email|max:45',
         //   'cgm.nacionalidade_id' => 'integer',
         //   'cgm.naturalidade' => 'required|serbinario_alpha_space|max:45',
         //   'cgm.numero_nis' => 'required|numeric|digits_between:0,30',

            //Tabela telefone
            'telefone.nome' => 'required|numeric|digits_between:0,20',

            //Tabela endereco
          //  'cgm.endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
         //   'cgm.endereco.zona_id' => 'integer',
         //   'cgm.endereco.numero' => 'required|numeric|digits_between:0,8',
         //   'cgm.endereco.complemento' => 'serbinario_alpha_space|max:150',
         //   'cgm.endereco.cep' => 'numeric|digits_between:0,12',
        //    'cgm.endereco.bairro_id' => 'integer',
        ],
   ];
}
