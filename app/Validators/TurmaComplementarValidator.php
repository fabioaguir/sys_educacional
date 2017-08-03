<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TurmaComplementarValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;
    
    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'escola_id' => 'Escola',
        'tipo_atendimento_id' => 'Tipo de Atendimento',
        'turno_id' => 'Turno',
        'dependencia_id' => 'Dependência',
        'vagas' => 'Vagas',
        'aprovacao_automatica' => 'Aprovação Automática',
        'observacao' => 'Observação',
        'quantidade_atividade_id' => 'Quantidade de Atividades',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'codigo' => 'required|max:50|unique:edu_turmas,codigo',
            'nome' => 'required|max:100',
            'escola_id' => 'required|numeric',
            'tipo_atendimento_id' => 'required|numeric',
            'calendario_id' => 'required|numeric',
            'turno_id' => 'required|numeric',
            'dependencia_id' => 'required|numeric',
            'quantidade_atividade_id' => 'required|numeric',
            'vagas' => 'required|numeric',
            'aprovacao_automatica' => 'required|numeric',
            'observacao' => 'max:500'

        ],
        ValidatorInterface::RULE_UPDATE => [
            'codigo' => 'required|max:50|unique:edu_turmas,codigo,:id',
            'nome' => 'required|max:100',
            'escola_id' => 'required|numeric',
            'tipo_atendimento_id' => 'required|numeric',
            'calendario_id' => 'required|numeric',
            'turno_id' => 'required|numeric',
            'dependencia_id' => 'required|numeric',
            'quantidade_atividade_id' => 'required|numeric',
            'vagas' => 'required|numeric',
            'aprovacao_automatica' => 'required|numeric',
            'observacao' => 'max:500'
        ],
   ];
}
