<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PivotEscolaCurso extends Pivot implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'escolas_cursos';

    /**
     * @var array
     */
    protected $fillable = [
        'escola_id',
        'curso_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function turnos()
    {
        return $this->belongsToMany(Turno::class, "escolas_cursos_turnos", "escola_curso_id", "turno_id");
    }
}