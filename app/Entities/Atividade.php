<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Atividade extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_atividades';

    protected $fillable = [
        'horas_manha',
        'horas_tarde',
        'horas_noite',
        'funcoes_id',
        'servidor_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function funcao()
    {
        return $this->belongsTo(Funcao::class, 'funcoes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servidor()
    {
        return $this->belongsTo(Servidor::class, 'servidor_id');
    }

}
