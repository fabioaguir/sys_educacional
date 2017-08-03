<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Parecer extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_pareceres';
    
    protected $fillable = [
        'nome',
        'codigo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'turmas_pareceres', 'parecer_id', 'turma_id');
    }

}
