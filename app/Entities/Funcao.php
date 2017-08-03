<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Funcao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_funcoes';

    protected $fillable = [
        'nome',
        'sigla',
        'funcao_professor'
    ];

}
