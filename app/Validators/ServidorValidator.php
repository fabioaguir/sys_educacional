<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ServidorValidator extends LaravelValidator
{

    use TraitReplaceRulesValidator;

    protected $attributes = [
        'data_admicao' => 'Data de admição',
        'carga_horaria' => 'Carga horária',
        'tipo_vinculo_servidor_id' => 'Tipo de vínculo',
        'cargos_id' => 'Cargo',
        'funcoes_id' => 'Função',
    ];

    protected $rules = [
        
        ValidatorInterface::RULE_CREATE => [

            //Tabela CGM
            'cgm.nome' => 'required',
            'cgm.sexo_id' => 'required',
            'cgm.data_nascimento' => 'required|serbinario_date_format:"d/m/Y"',
            'cgm.nacionalidade_id' => 'required',
            'cgm.cgm_municipio_id' => 'required',
            'cgm.estado_civil_id' => 'required',
            'cgm.escolaridade_id' => 'required',
            'cgm.cpf' => 'required',
            'cgm.rg' => 'required',
            'cgm.rg' => 'required',

            //Tabela Servidor
            'data_admicao' => 'required|serbinario_date_format:"d/m/Y"',
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
        
        ValidatorInterface::RULE_UPDATE => [
            'data_admicao' => 'required|serbinario_date_format:"d/m/Y"',
            'carga_horaria' => 'required',
            'tipo_vinculo_servidor_id' => 'required',
            'cargos_id' => 'required',
            'funcoes_id' => 'required',
        ],
   ];
}
