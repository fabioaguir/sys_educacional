<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\CargoRepository;
use SerEducacional\Entities\Cargo;
use SerEducacional\Validators\CargoValidator;

/**
 * Class CargoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class CargoRepositoryEloquent extends BaseRepository implements CargoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cargo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CargoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
