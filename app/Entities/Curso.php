<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Curso extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'nome',
        'codigo',
        'nivel_curso_id',
        'regime_curso_id',
        'tipo_curso_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nivelCurso()
    {
        return $this->belongsTo(NivelCurso::class, 'nivel_curso_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regimeCurso()
    {
        return $this->belongsTo(RegimeCurso::class, 'regime_curso_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoCurso()
    {
        return $this->belongsTo(TipoCurso::class, 'tipo_curso_id');
    }
}
