<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Horario extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'horarios';

    protected $fillable = [
        'horas_id',
        'turmas_id',
        'disciplinas_id',
        'servidor_id',
        'dia_semana_id'
    ];
}
