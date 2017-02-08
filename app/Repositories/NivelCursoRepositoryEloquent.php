<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\NivelCursoRepository;
use SerEducacional\Entities\NivelCurso;
use SerEducacional\Validators\NivelCursoValidator;

/**
 * Class NivelCursoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class NivelCursoRepositoryEloquent extends BaseRepository implements NivelCursoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NivelCurso::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
