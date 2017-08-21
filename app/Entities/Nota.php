<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Nota extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_notas';

    protected $fillable = [
        'nota_ativ1',
        'nota_ativ2',
        'nota_ativ3',
        'nota_verif_aprend',
        'media',
        'recup_paralela',
        'nota_para_recup',
        'aluno_id',
        'turma_id',
        'disciplina_id',
        'periodo_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

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
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

}
