<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class AlunoTurma extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_alunos_turmas';

    protected $fillable = [
        'alunos_id',
        'turmas_id',
        'data_matricula',
        'matricula',
        'data_saida'
    ];

    /**
     * @return string
     */
    public function getDataMatriculaAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_matricula']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataMatriculaAttribute($value)
    {
        $this->attributes['data_matricula'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return string
     */
    public function getDataSaidaAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_saida']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataSaidaAttribute($value)
    {
        $this->attributes['data_saida'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turmas_id');
    }
}
