<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\FuncaoRepository;
use SerEducacional\Entities\Funcao;
use SerEducacional\Validators\FuncaoValidator;

/**
 * Class FuncaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class FuncaoRepositoryEloquent extends BaseRepository implements FuncaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Funcao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FuncaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
