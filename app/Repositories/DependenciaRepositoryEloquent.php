<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\DependenciaRepository;
use SerEducacional\Entities\Dependencia;
use SerEducacional\Validators\DependenciaValidator;

/**
 * Class DependenciaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class DependenciaRepositoryEloquent extends BaseRepository implements DependenciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Dependencia::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DependenciaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
