<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class PessoaFisica extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'cgm';

    protected $fillable = [
        'estado_civil_id',
        'sexo_id',
        'nacionalidade_id',
        'cgm_municipio_id',
        'escolaridade_id',
        'endereco_id',
        'num_cgm',
        'cpf',
        'rg',
        'orgao_emissor',
        'nome',
        'pai',
        'mae',
        'naturalidade',
        'inscricao_estadual',
        'data_nascimento',
        'data_falecimento',
        'data_expedicao',
        'data_cadastramento',
        'data_vencimento_cnh',
        'email',
        'num_cnh',
        'cnh_categoria_id',
        'email'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servidor()
    {
        return $this->hasMany(Servidor::class, 'id_cgm');
    }

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

   /**
     * @return string
     */
    public function getDataNascimentoAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_nascimento']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataNascimentoAttribute($value)
    {
        $this->attributes['data_nascimento'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     *
     * @return \DateTime
     */
    public function getDataFalecimentoAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_falecimento']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataFalecimentoAttribute($value)
    {
        $this->attributes['data_falecimento'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     *
     * @return \DateTime
     */
    public function getDataExpedicaoAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_expedicao']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataExpedicaoAttribute($value)
    {
        $this->attributes['data_expedicao'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     *
     * @return \DateTime
     */
    public function getDataCadastramentoAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_cadastramento']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataCadastramentoAttribute($value)
    {
        $this->attributes['data_cadastramento'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     *
     * @return \DateTime
     */
    public function getDataVencimentoCnhAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_vencimento_cnh']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataVencimentoCnhAttribute($value)
    {
        $this->attributes['data_vencimento_cnh'] = SerbinarioDateFormat::toUsa($value);
    }
}