<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class PeriodoAvaliacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_periodos_avaliacao';

    protected $fillable = [
        'data_inicial',
        'data_final',
        'dias_letivos',
        'semanas_letivas',
        'total_dias_letivos',
        'total_semanas_letivas',
        'periodos_id',
        'calendarios_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function calendario()
    {
        return $this->belongsTo(Calendario::class, 'calendarios_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodos_id');
    }
}
