<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ModalidadeEnsino extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'modalidades';

    protected $fillable = [
        'nome',
        'codigo'
    ];

}
