<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AreaTrabalho extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_area_trabalho';

    protected $fillable = [
        'nome'
    ];

}
