<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\AlunoTurmaRepository;
use SerEducacional\Entities\AlunoTurma;
use SerEducacional\Validators\AlunoTurmaValidator;

/**
 * Class AlunoTurmaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class AlunoTurmaRepositoryEloquent extends BaseRepository implements AlunoTurmaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AlunoTurma::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AlunoTurmaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
