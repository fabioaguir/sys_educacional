<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Escola extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'escola';

    protected $fillable = [
        'codigo',
        'nome',
        'nome_abreviado',
        'coordenadoria_id',
        'mantenedora_id',
        'ano_incio',
        'endereco_id',
        'email',
        'telefone',
        'zona_id',
        'dt_pub_portaria',
        'instituicao_id',
        'localizacao_escola_id',
        'latitude',
        'longitude',
        'inep',
        'portaria'
    ];

    /**
     * @return string
     */
    public function getDtPubPortariaAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['dt_pub_portaria']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDtPubPortariaAttribute($value)
    {
        $this->attributes['dt_pub_portaria'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }
}
