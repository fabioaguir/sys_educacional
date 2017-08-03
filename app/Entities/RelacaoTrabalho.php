<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RelacaoTrabalho extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_relacao_trabalho';

    protected $fillable = [
        'regime_trabalho_id',
        'area_trabalho_id',
        'disciplinas_id',
        'niveis_ensino_id',
        'servidor_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regime()
    {
        return $this->belongsTo(RegimeTrabalho::class, 'regime_trabalho_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(AreaTrabalho::class, 'area_trabalho_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplinas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ensino()
    {
        return $this->belongsTo(NivelEnsino::class, 'niveis_ensino_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servidor()
    {
        return $this->belongsTo(Servidor::class, 'servidor_id');
    }

}
