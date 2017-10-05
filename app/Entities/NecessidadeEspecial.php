<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class NecessidadeEspecial extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_necessidade_especial';

    protected $fillable = [
        'nome',
    ];
}
