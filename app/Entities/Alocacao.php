<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Alocacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'alocacoes';

    protected $fillable = [
        'servidor_id',
        'escola_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servidor()
    {
        return $this->belongsTo(Servidor::class, 'servidor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function escola()
    {
        return $this->belongsTo(Escola::class, 'escola_id');
    }

}
