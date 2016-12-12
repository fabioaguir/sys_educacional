<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CgmMunicipio extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'cgm_municipio';

    protected $fillable = [
        'nome'
    ];
}