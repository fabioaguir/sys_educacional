<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ControleFrequencia extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_controles_frequencias';

    protected $fillable = [
        'nome',
        'codigo'
    ];

}
