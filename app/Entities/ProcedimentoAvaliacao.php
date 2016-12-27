<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProcedimentoAvaliacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'procedimentos_avaliacoes';
    
    protected $fillable = [
        'nome',
        'codigo',
        'frequencia_minima_avaliacao'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedimentos()
    {
        return $this->hasMany(Procedimento::class, 'procedimento_avaliacao_id');
    }

}
