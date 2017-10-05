<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TransporteEscolar extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_transporte_escolar';

    protected $fillable = [
        'nome',
    ];
}
