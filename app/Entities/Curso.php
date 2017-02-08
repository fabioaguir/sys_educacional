<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Curso extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'nome',
        'codigo',
        'nivel_ensino_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nivelEnsino()
    {
        return $this->belongsTo(NivelEnsino::class, 'nivel_ensino_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function curriculos()
    {
        return $this->hasMany(Curriculo::class, 'curso_id');
    }

    /**
     * @return $this
     */
    public function escolas()
    {
        return $this->belongsToMany(Escola::class, 'escolas_cursos', 'curso_id', 'escola_id')
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
        if ($parent instanceof Escola) {
            return new PivotEscolaCurso($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}
