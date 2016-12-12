<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CategoriaCnh extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'categoria_cnh';

    protected $fillable = [
        'nome'
    ];
}
