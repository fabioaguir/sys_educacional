<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Servidor extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'servidor';

    protected $fillable = [
        'matricula',
        'carteira_prof',
        'serie_carteira',
        'titulo_eleitor',
        'sessao_titulo_eleitor',
        'zona_titulo_eleitor',
        'pis_pasep',
        'id_instituicao',
        'id_cgm',
        'inep',
        'data_admicao',
        'carga_horaria',
        'tipo_vinculo_servidor_id',
        'habilitacao_escolaridade_id',
        'cargos_id',
        'funcoes_id',
        'situacao_servidores_id'
    ];

    /**
     * @return string
     */
    public function getDataAdmicaoAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_admicao']);
    }
    
    /**
     *
     * @return \DateTime
     */
    public function setDataAdmicaoAttribute($value)
    {
        $this->attributes['data_admicao'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cgm()
    {
        return $this->belongsTo(PessoaFisica::class, 'id_cgm');
    }
}