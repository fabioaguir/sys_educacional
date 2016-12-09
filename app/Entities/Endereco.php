<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Endereco extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'endereco';

    protected $fillable = [
        'logradouro',
        'numero',
        'complemento',
        'cep',
        'bairro_id'
    ];

    /**
     * @return mixed
     */
    public function pessoaFisica()
    {
        return $this->$this->hasMany(PessoaFisica::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bairro()
    {
        return $this->belongsTo(Bairro::class);
    }
}