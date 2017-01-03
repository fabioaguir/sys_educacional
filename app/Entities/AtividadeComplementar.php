<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AtividadeComplementar extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'atividades_complementares';

    protected $fillable = [
        'nome',
        'codigo'
    ];

}