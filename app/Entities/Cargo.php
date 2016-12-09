<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cargo extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'cargos';

    protected $fillable = [
        'nome'
    ];

}
