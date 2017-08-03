<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Aluno extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_alunos';

    protected $fillable = [
        'codigo',
        'num_nis',
        'num_inep',
        'cgm_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cgm()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matricula()
    {
        return $this->hasMany(AlunoTurma::class, 'alunos_id');
    }
}