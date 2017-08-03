<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Mantenedora extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'edu_mantenedora';

    protected $fillable = [
        'codigo',
        'nome',
        'nome_abreviado',
        'coordenadoria_id',
        'mantenedora_id',
        'ano_inicio',
        'endereco_id',
        'email',
        'telefone',
        'zona_id',
        'dt_pub_portaria',
        'instituicao_id',
        'localizacao_escola_id',
        'latitude',
        'logitude',
        'inep',
        'portaria'
    ];
}
