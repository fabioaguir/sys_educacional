<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TipoEvento extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'tipo_evento';

    protected $fillable = [
        'nome',
        'abreviatura',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'tipo_evento_id');
    }
}
