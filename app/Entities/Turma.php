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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function curriculo()
    {
        return $this->belongsTo(Curriculo::class, 'curriculo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
