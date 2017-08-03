<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PessoaJuridica extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'gen_cgm';

    protected $fillable = [
        'nome',
        'num_cgm',
        'data_cadastramento',
        'cnpj',
        'email',
        'tipo_empresa_id',
        'nire',
        'nome_complemento',
        'nome_fantasia',
        'tipo_cadastro',
        'inscricao_estadual',
        'endereco_id',
        'cgm_municipio_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function telefone()
    {
        return $this->hasMany(Telefone::class, 'cgm_id');
    }
}