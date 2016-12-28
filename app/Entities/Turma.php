<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Turma extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'turmas';

    protected $fillable = [
        'codigo',
        'nome',
        'escola_id',
        'tipo_atendimento_id',
        'calendario_id',
        'curso_id',
        'curriculo_id',
        'serie_id',
        'procedimento_avaliacao_id',
        'turno_id',
        'dependencia_id',
        'vagas',
        'aprovacao_automatica',
        'observacao'
    ];

}
