<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DiaSemana extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'dias_semana';

    protected $fillable = [
        'nome',
        'codigo'
    ];

}
