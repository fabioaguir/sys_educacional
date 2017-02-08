<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cargo extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'cargos';

    protected $fillable = [
        'nome',
        'codigo',
        'cargo_professor',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servidores()
    {
        return $this->hasMany(Servidor::class, 'cargos_id');
    }
}
