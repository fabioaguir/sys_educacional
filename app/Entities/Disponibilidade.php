<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Disponibilidade extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'disponibilidades';

    protected $fillable = [
        'dia_semana_id',
        'hora_id',
        'escola_id',
        'servidor_id',
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
    public function dia()
    {
        return $this->belongsTo(DiaSemana::class, 'dia_semana_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function horario()
    {
        return $this->belongsTo(Hora::class, 'hora_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function escola()
    {
        return $this->belongsTo(Escola::class, 'escola_id');
    }

}
