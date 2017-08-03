<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TurmaComplementar extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_turmas';

    protected $fillable = [
        'codigo',
        'nome',
        'escola_id',
        'tipo_atendimento_id',
        'calendario_id',
        'turno_id',
        'dependencia_id',
        'vagas',
        'aprovacao_automatica',
        'observacao',
        'tipo_turma_id',
        'quantidade_atividade_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function atividades()
    {
        return $this->belongsToMany(Serie::class, 'edu_turmas_atividades', 'turma_id', 'atividade_id')
            ->withPivot(['id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'edu_alunos_turmas_complementares', 'turma_complementar_id', 'aluno_id')
            ->withPivot(['id', 'data_inclusao']);
    }
}