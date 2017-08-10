<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Historico extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_historico';

    protected $fillable = [
        'matricula',
        'data_matricula',
        'data_saida',
        'aluno_id',
        'serie_id',
        'turma_id',
        'escola_id',
        'situacao_matricula_id',
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
    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
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
    public function escola()
    {
        return $this->belongsTo(Escola::class, 'escola_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function situacao()
    {
        return $this->belongsTo(SituacaoMatricula::class, 'situacao_matricula_id');
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
}
