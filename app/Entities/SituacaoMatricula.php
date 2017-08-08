<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SituacaoMatricula extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_situacao_matricula';

    protected $fillable = [
        'nome',
    ];

}
