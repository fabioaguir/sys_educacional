<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Telefone extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_telefones';

    protected $fillable = [
        'nome',
        'cgm_id',
        'tipo_telefones_id',
        'ramal',
        'observacao'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pessoaFisica()
    {
        return $this->belongsTo(PessoaFisica::class, 'cgm_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoTelefone()
    {
        return $this->belongsTo(TipoTelefone::class, 'tipo_telefones_id');
    }

}
