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
        'nivel_ensino_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nivelEnsino()
    {
        return $this->belongsTo(NivelEnsino::class, 'nivel_ensino_id');
    }
}
