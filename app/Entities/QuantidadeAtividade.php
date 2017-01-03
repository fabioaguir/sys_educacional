<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class QuantidadeAtividade extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'quantidades_atividades';

    protected $fillable = [
        'nome',
        'codigo'
    ];

}
