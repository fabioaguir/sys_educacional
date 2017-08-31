<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class FrequenciaCurriculo extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_frequencia_curriculo';

    protected $fillable = [
        'nome',
    ];
}
