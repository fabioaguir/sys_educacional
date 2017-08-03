<?php

namespace SerEducacional\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class NivelCurso extends Model implements Transformable
{
    use TransformableTrait;
    
    protected $table = 'edu_nivel_cursos';
    
    protected $fillable = [];

}
