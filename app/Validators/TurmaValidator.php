<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TurmaValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;
    
    protected $attributes = [
        'nome' => 'Nome',
        'codigo' => 'Código',
        'escola_id' => 'Escola',
        'tipo_atendimento_id' => 'Tipo de Atendimento',
        'calendario_id' => 'Calendário',
        'curso_id' => 'Curso',
        'curriculo_id' => 'Currículo',
        'serie_id' => 'Série',
        'forma_avaliacao_id' => 'Forma de Avaliação',
        'turno_id' => 'Turno',
        'dependencia_id' => 'Dependência',
        'vagas' => 'Vagas',
        'aprovacao_automatica' => 'Aprovação Automática',
        'observacao' => 'Observação'
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
            'curso_id' => 'required|numeric',
            'curriculo_id' => 'required|numeric',
            'serie_id' => 'required|numeric',
            'forma_avaliacao_id' => 'required|numeric',
            'turno_id' => 'required|numeric',
            'dependencia_id' => 'required|numeric',
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
            'curso_id' => 'required|numeric',
            'curriculo_id' => 'required|numeric',
            'serie_id' => 'required|numeric',
            'forma_avaliacao_id' => 'required|numeric',
            'turno_id' => 'required|numeric',
            'dependencia_id' => 'required|numeric',
            'vagas' => 'required|numeric',
            'aprovacao_automatica' => 'required|numeric',
            'observacao' => 'max:500'
        ],
   ];
}
