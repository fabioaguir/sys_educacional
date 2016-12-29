<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SituacaoFormacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'situacao_formacao';

    protected $fillable = [
        'nome'
    ];

}
