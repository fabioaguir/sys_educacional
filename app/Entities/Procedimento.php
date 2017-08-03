<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Procedimento extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_procedimentos';

    protected $fillable = [
        'forma_avaliacao_id',
        'procedimento_avaliacao_id',
        'periodo_avaliacao_id',
        'aparecer_boletim'
    ];

}
