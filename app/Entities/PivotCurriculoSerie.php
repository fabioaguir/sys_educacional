<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PivotCurriculoSerie extends Pivot implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'curriculos_series';

    /**
     * @var array
     */
    protected $fillable = [
        'curriculo_id',
        'serie_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class, "curriculos_series_disciplinas", "curriculo_serie_id", "disciplina_id");
    }
}