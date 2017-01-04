<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\PeriodoRepository;
use SerEducacional\Entities\Periodo;
use SerEducacional\Validators\PeriodoValidator;

/**
 * Class PeriodoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class PeriodoRepositoryEloquent extends BaseRepository implements PeriodoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Periodo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PeriodoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
