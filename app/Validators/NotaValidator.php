<?php

namespace SerEducacional\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class NotaValidator extends LaravelValidator
{
    use TraitReplaceRulesValidator;

    protected $attributes = [
        'nota_ativ1' => '',
        'nota_ativ2' => '',
        'nota_ativ3' => '',
        'nota_verif_aprend' => '',
        'codigo' => '',
        'media' => '',
        'recup_paralela' => '',
        'nota_para_recup' => '',
        'aluno_id' => '',
        'turma_id' => '',
        'disciplina_id' => '',
        'periodo_id' => '',
    ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'max' => ':attribute só pode ter no máximo :max caracteres',
        'unique' => ':attribute já está cadastrado'
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nota_ativ1' => '',
            'nota_ativ2' => '',
            'nota_ativ3' => '',
            'nota_verif_aprend' => '',
            'codigo' => '',
            'media' => '',
            'recup_paralela' => '',
            'nota_para_recup' => '',
            'aluno_id' => '',
            'turma_id' => '',
            'disciplina_id' => '',
            'periodo_id' => '',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nota_ativ1' => '',
            'nota_ativ2' => '',
            'nota_ativ3' => '',
            'nota_verif_aprend' => '',
            'codigo' => '',
            'media' => '',
            'recup_paralela' => '',
            'nota_para_recup' => '',
            'aluno_id' => '',
            'turma_id' => '',
            'disciplina_id' => '',
            'periodo_id' => '',
        ],
   ];
}
