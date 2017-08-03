<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SerEducacional\Uteis\SerbinarioDateFormat;

class Escola extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'edu_escola';

    protected $fillable = [
        'codigo',
        'nome',
        'nome_abreviado',
        'coordenadoria_id',
        'mantenedora_id',
        'ano_incio',
        'endereco_id',
        'email',
        'telefone',
        'zona_id',
        'dt_pub_portaria',
        'instituicao_id',
        'localizacao_escola_id',
        'latitude',
        'longitude',
        'inep',
        'portaria'
    ];

    /**
     * @return string
     */
    public function getDtPubPortariaAttribute()
    {
        return SerbinarioDateFormat::toBrazil($this->attributes['dt_pub_portaria']);
    }

    /**
     *
     * @return \DateTime
     */
    public function setDtPubPortariaAttribute($value)
    {
        $this->attributes['dt_pub_portaria'] = SerbinarioDateFormat::toUsa($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alocacoes()
    {
        return $this->hasMany(Alocacao::class, 'escola_id');
    }

    /**
     * @return $this
     */
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'edu_escolas_cursos', 'escola_id', 'curso_id')
            ->withPivot(['id']);
    }

    /**
     * @param Model $parent
     * @param array $attributes
     * @param string $table
     * @param bool $exists
     * @return \Illuminate\Database\Eloquent\Relations\Pivot|Disciplina
     */
    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Curso) {
            return new PivotEscolaCurso($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}
