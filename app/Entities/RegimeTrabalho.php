<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RegimeTrabalho extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'regime_trabalho';

    protected $fillable = [
        'nome'
    ];

}
