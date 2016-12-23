<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class FormaAvaliacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'formas_avaliacoes';

    protected $fillable = [
        'nome',
        'codigo',
        'tipo_resultado_id',
        'maior_nota',
        'menor_nota',
        'variacao',
        'minimo_aprovacao',
        'parecer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoResultado()
    {
        return $this->belongsTo(TipoResultado::class, 'tipo_resultado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function niveisAlfabetizacao()
    {
        return $this->hasMany(NivelAlfabetizacao::class, 'forma_avaliacao_id');
    }
}
