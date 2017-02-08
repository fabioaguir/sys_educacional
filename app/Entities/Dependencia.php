<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Dependencia extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'dependencias';

    protected $fillable = [
        'nome',
        'capacidade',
        'escola_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function escola()
    {
        return $this->belongsTo(Escola::class, 'escola_id');
    }
}
