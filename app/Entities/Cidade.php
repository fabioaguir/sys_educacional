<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cidade extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'cidades';

    protected $fillable = [
    'nome'
];

    /**
     * @return mixed
     */
    public function bairro()
    {
        return $this->hasMany(Bairro::class);
    }
}
