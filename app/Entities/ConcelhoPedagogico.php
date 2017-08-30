<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ConcelhoPedagogico extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_concelho_pedagogico';

    protected $fillable = [
        'dificuldades',
        'orientacoes',
        'turma_id',
        'periodo_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

}
