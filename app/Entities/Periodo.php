<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Periodo extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'periodos';

    protected $fillable = [
        'nome',
        'abreviatura',
        'soma_carga_horaria',
        'controle_frequencia',
        'ordenacao',
    ];

}
