<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Curriculo extends Model implements Transformable
{
    use TransformableTrait;

    protected $dates = [
        'validade_inicio',
        'validade_fim'
    ];

    protected $fillable = [
        'nome',
        'codigo',
        'curso_id',
        'validade_inicio',
        'validade_fim',
        'ativo'
    ];

    /**
     * @return string
     */
    public function getValidadeInicioAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['validade_inicio']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setValidadeInicioAttribute($value)
    {
        $this->attributes['validade_inicio'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return string
     */
    public function getValidadeFimAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['validade_fim']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setValidadeFimAttribute($value)
    {
        $this->attributes['validade_fim'] = SerbinarioDateFormat::toUsa($value);
    }

}
