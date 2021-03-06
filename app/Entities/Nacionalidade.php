<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Nacionalidade extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'gen_nacionalidade';

    protected $fillable = [
        'nome'
    ];
}
