<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Instituicao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'Instituicao';

    protected $fillable = [
        'nome',
        'cnpj',
        'insc_municipal',
        'insc_estadual',
        'endereco_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

}
