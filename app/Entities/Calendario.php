<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Calendario extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'calendarios';

    protected $fillable = [
        'nome',
        'ano',
        'data_inicial',
        'data_final',
        'data_resultado_final',
        'dias_letivos',
        'semanas_letivas',
        'status_id',
        'duracoes_id'
    ];

    /**
     * @return string
     */
    public function getDataInicialAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_inicial']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataInicialAttribute($value)
    {
        $this->attributes['data_inicial'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return string
     */
    public function getDataFinalAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_final']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataFinalAttribute($value)
    {
        $this->attributes['data_final'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return string
     */
    public function getDataResultadoFinalAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_resultado_final']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataResultadoFinalAttribute($value)
    {
        $this->attributes['data_resultado_final'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(PessoaFisica::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function duracao()
    {
        return $this->belongsTo(PessoaFisica::class, 'duracoes_id');
    }
}
