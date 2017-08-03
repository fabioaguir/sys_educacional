<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TipoAtendimento extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_tipos_atendimentos';
    
    protected $fillable = [
        'nome',
        'codigo'
    ];

}
