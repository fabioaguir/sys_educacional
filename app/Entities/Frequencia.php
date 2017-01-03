<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Frequencia extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'frequencias';

    protected $fillable = [
        'nome',
        'codigo'
    ];

}
