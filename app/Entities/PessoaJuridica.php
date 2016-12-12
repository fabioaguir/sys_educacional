<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PessoaJuridica extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'cgm';

    protected $fillable = [
        'nome',
        'cgmmunicipio',
        'num_cgm',
        'data_cadastramento',
        'cnpj',
        'email',
        'tipo_empresa_id',
        'nire',
        'nome_complemento',
        'nome_fantasia',
        'tipo_cadastro'
    ];
}