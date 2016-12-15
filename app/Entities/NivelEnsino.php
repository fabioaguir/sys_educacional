<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class NivelEnsino extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'niveis_ensino';

    protected $fillable = [
        'nome',
        'codigo',
        'modalidade_id'
    ];
}
