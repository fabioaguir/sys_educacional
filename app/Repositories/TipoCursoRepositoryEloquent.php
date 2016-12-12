<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\TipoCursoRepository;
use SerEducacional\Entities\TipoCurso;
use SerEducacional\Validators\TipoCursoValidator;

/**
 * Class TipoCursoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class TipoCursoRepositoryEloquent extends BaseRepository implements TipoCursoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoCurso::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
