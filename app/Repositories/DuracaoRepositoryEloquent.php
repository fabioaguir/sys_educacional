<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\DuracaoRepository;
use SerEducacional\Entities\Duracao;
use SerEducacional\Validators\DuracaoValidator;

/**
 * Class DuracaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class DuracaoRepositoryEloquent extends BaseRepository implements DuracaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Duracao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DuracaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
