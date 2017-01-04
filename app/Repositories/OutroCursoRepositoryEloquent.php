<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\OutroCursoRepository;
use SerEducacional\Entities\OutroCurso;
use SerEducacional\Validators\OutroCursoValidator;

/**
 * Class OutroCursoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class OutroCursoRepositoryEloquent extends BaseRepository implements OutroCursoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OutroCurso::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
