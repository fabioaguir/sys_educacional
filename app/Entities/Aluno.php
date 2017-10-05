<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Aluno extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_alunos';

    protected $fillable = [
        'codigo',
        'num_nis',
        'num_inep',
        'cgm_id',
        'nome_cartorio_rg_civil',
        'num_registro_nascimento',
        'livro',
        'folha',
        'cidade_certidao',
        'data_emissao',
        'profissao_pai',
        'profissao_mae',
        'cid_patologia',
        'necessidade_especial_id',
        'transporte_escolar_id'
    ];

    /**
     * @return string
     */
    public function getDataEmissaoAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['data_emissao']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDataEmissaoAttribute($value)
    {
        $this->attributes['data_emissao'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cgm()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matricula()
    {
        return $this->hasMany(AlunoTurma::class, 'alunos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_certidao');
    }
}