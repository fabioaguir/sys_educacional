<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\CalendarioRepository;
use SerEducacional\Entities\Calendario;
use SerEducacional\Validators\CalendarioValidator;

/**
 * Class CalendarioRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class CalendarioRepositoryEloquent extends BaseRepository implements CalendarioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Calendario::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CalendarioValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
