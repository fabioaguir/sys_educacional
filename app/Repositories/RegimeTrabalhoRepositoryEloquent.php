<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\RegimeTrabalhoRepository;
use SerEducacional\Entities\RegimeTrabalho;
use SerEducacional\Validators\RegimeTrabalhoValidator;

/**
 * Class RegimeTrabalhoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class RegimeTrabalhoRepositoryEloquent extends BaseRepository implements RegimeTrabalhoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RegimeTrabalho::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RegimeTrabalhoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
