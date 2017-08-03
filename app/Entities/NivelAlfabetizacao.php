<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class NivelAlfabetizacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_niveis_alfabetizacao';

    protected $fillable = [
        'nome',
        'codigo',
        'forma_avaliacao_id',
        'minimo_aprovacao'
    ];

}
