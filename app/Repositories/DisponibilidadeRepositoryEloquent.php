<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\DisponibilidadeRepository;
use SerEducacional\Entities\Disponibilidade;
use SerEducacional\Validators\DisponibilidadeValidator;

/**
 * Class DisponibilidadeRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class DisponibilidadeRepositoryEloquent extends BaseRepository implements DisponibilidadeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Disponibilidade::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DisponibilidadeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
