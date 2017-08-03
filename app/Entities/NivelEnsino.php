<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class NivelEnsino extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_niveis_ensino';

    protected $fillable = [
        'nome',
        'codigo',
        'modalidade_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function curso()
    {
        return $this->hasMany(Curso::class);
    }
}