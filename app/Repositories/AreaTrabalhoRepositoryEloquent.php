<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\AreaTrabalhoRepository;
use SerEducacional\Entities\AreaTrabalho;
use SerEducacional\Validators\AreaTrabalhoValidator;

/**
 * Class AreaTrabalhoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class AreaTrabalhoRepositoryEloquent extends BaseRepository implements AreaTrabalhoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AreaTrabalho::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AreaTrabalhoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
