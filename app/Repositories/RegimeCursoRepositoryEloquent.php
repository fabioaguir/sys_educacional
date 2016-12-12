<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\RegimeCursoRepository;
use SerEducacional\Entities\RegimeCurso;
use SerEducacional\Validators\RegimeCursoValidator;

/**
 * Class RegimeCursoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class RegimeCursoRepositoryEloquent extends BaseRepository implements RegimeCursoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RegimeCurso::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
