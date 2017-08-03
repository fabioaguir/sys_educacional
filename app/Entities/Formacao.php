<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Formacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_formacoes';

    protected $fillable = [
        'ano_conclusao',
        'servidor_id',
        'cursos_formacao_id',
        'situacao_formacao_id',
        'instituicoes_formacao_id',
        'licenciatura_id',
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
    public function curso()
    {
        return $this->belongsTo(CursoFormacao::class, 'cursos_formacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function situacao()
    {
        return $this->belongsTo(SituacaoFormacao::class, 'situacao_formacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instituicao()
    {
        return $this->belongsTo(InstituicaoFormacao::class, 'instituicoes_formacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function licenciatura()
    {
        return $this->belongsTo(Licenciatura::class, 'licenciatura_id');
    }
}
