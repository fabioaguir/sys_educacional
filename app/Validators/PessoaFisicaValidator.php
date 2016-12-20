<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PessoaFisicaValidator extends LaravelValidator
{

    protected $attributes = [
        'estado_civil_id' => 'Estado civil',
        'sexo_id' => 'Sexo',
        'nacionalidade_id' => 'Nacionalidade',
        'cgm_municipio_id' => 'CGM do Município',
        'escolaridade_id' => 'Nível de Escolaridade',
        'endereco_id' => 'Id de endereço',

    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'serbinario_alpha_space' => ' :attribute deve conter apenas letras e espaços entre palavras'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|serbinario_alpha_space',
            'sigla' => 'serbinario_alpha_space',
            'funcao_professor' => 'integer'
        ],

        /*
        'num_cgm',
        'cpf',
        'rg',
        'orgao_emissor',
        'nome',
        'pai',
        'mae',
        'naturalidade',
        'inscricao_estadual',
        'data_nascimento',
        'data_falecimento',
        'data_expedicao',
        'data_cadastramento',
        'data_vencimento_cnh',
        'email',
        'num_cnh',
        'cnh_categoria_id',
        'email'*/

        ValidatorInterface::RULE_UPDATE => [

        ],
   ];
}
