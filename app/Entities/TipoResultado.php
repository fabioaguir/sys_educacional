<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TipoResultado extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_tipos_resultados';

    protected $fillable = [
        'nome',
        'codigo'
    ];

}
