<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CursoFormacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_cursos_formacao';

    protected $fillable = [
        'nome'
    ];

}
