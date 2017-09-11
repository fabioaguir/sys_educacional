<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TipoUsuario extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'tipo_usuario';

    protected $fillable = [
        'nome',
    ];

}
