<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\AtividadeRepository;
use SerEducacional\Entities\Atividade;
use SerEducacional\Validators\AtividadeValidator;

/**
 * Class AtividadeRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class AtividadeRepositoryEloquent extends BaseRepository implements AtividadeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Atividade::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AtividadeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
