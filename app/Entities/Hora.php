<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Hora extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'horas';

    protected $fillable = [
        'hora_inicial',
        'hora_final',
        'codigo',
        'turnos_id'
    ];

}
