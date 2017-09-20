<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Horario extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_horarios';

    protected $fillable = [
        'horas_id',
        'turmas_id',
        'disciplinas_id',
        'servidor_id',
        'dia_semana_id'
    ];

    /**
     * @return mixed
     */
    public function hora()
    {
        return $this->belongsTo(Hora::class, 'horas_id');
    }
}
