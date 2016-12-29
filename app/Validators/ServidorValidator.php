<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ServidorValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'cgm.nome' => 'Nome',
        'cgm.sexo_id' => 'Sexo',
        'cgm.data_nascimento' => 'Data de Nascimento',
        'cgm.nacionalidade_id' => 'Nacionalidade',
        'cgm.cgm_municipio_id' => 'CGM Município',
        'cgm.estado_civil_id' => 'Estado Civil',
        'cgm.escolaridade_id' => 'Escolaridade',
        'cgm.cpf' => 'CPF',
        'cgm.rg' => 'RG',

        'data_admicao' => 'Data de admissão',
        'carga_horaria' => 'Carga horária',
        'tipo_vinculo_servidor_id' => 'Tipo de vínculo',
        'cargos_id' => 'Cargo',
        'funcoes_id' => 'Função',

        'cgm.endereco.logradouro' => 'Logradouro',
        'cgm.endereco.numero' => 'Número (endereço)',
        'cgm.endereco.complemento' => 'Complemento (endereço)',
        'cgm.endereco.bairro_id' => 'Bairro'
    ];
    
    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras',
        'numeric' => ':attribute deve conter apenas números',
        'email' => ':attribute deve seguir esse exemplo: exemplo@dominio.com',
        'digits_between' => ':attribute deve ter entre :min e :max caracteres',
        'unique' => ':attribute valor já cadastrado'
    ];

    protected $rules = [
        
        ValidatorInterface::RULE_CREATE => [

           //Tabela CGM
            'cgm.nome' => 'required|serbinario_alpha_space|max:45',
            'cgm.sexo_id' => 'required|integer',
            'cgm.data_nascimento' => 'required|max:15',
            'cgm.data_falecimento' => 'required|max:15',
            'cgm.nacionalidade_id' => 'required|integer',
            'cgm.cgm_municipio_id' => 'required|integer',
            'cgm.estado_civil_id' => 'required|integer',
            'cgm.escolaridade_id' => 'required|integer',
            'cgm.cpf' => 'required|cpf_br|digits_between:0,15|unique:cgm,cpf',
            'cgm.rg' => 'required|numeric|digits_between:0,20',

            //Tabela Servidor
            'data_admicao' => 'required',
            'carga_horaria' => 'required|numeric',
            'tipo_vinculo_servidor_id' => 'required|integer',
            'cargos_id' => 'required|integer',
            'funcoes_id' => 'required|integer',

            //Tabela Endereço
            'cgm.endereco.logradouro' => 'required|serbinario_alpha_space|max:200',
            'cgm.endereco.numero' => 'required|numeric|digits_between:0,10',
            'cgm.endereco.complemento' => 'serbinario_alpha_space|max:120',
            'cgm.endereco.bairro_id' => 'integer'
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            //Tabela CGM
            'cgm.nome' => 'required',
            'cgm.sexo_id' => 'required',
            'cgm.data_nascimento' => 'required',
            'cgm.data_falecimento' => 'required|max:15',
            'cgm.nacionalidade_id' => 'required',
            'cgm.cgm_municipio_id' => 'required',
            'cgm.estado_civil_id' => 'required',
            'cgm.escolaridade_id' => 'required',
            'cgm.cpf' => 'required',
            'cgm.rg' => 'required',

            //Tabela Servidor
            'data_admicao' => 'required',
            'carga_horaria' => 'required',
            'tipo_vinculo_servidor_id' => 'required',
            'cargos_id' => 'required',
            'funcoes_id' => 'required',

            //Tabela Endereço
            'cgm.endereco.logradouro' => 'required',
            'cgm.endereco.numero' => 'required|max:99999',
            'cgm.endereco.complemento' => 'max:100',
            'cgm.endereco.bairro_id' => 'required|integer',
        ],
   ];
}
