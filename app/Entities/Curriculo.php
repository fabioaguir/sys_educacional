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
        'turno_id',
        'observacao',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function series()
    {
        return $this->belongsToMany(Serie::class, 'curriculos_series', 'curriculo_id', 'serie_id')
            ->withPivot(['id']);
    }

    /**
     * @param Model $parent
     * @param array $attributes
     * @param string $table
     * @param bool $exists
     * @return \Illuminate\Database\Eloquent\Relations\Pivot|Disciplina
     */
    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Serie) {
            return new PivotCurriculoSerie($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}