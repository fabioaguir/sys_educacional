<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\TurmaRepository;
use SerEducacional\Entities\Turma;
use SerEducacional\Validators\TurmaValidator;

/**
 * Class TurmaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class TurmaRepositoryEloquent extends BaseRepository implements TurmaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Turma::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TurmaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
