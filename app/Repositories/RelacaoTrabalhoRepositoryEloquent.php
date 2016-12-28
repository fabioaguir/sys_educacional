<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\RelacaoTrabalhoRepository;
use SerEducacional\Entities\RelacaoTrabalho;
use SerEducacional\Validators\RelacaoTrabalhoValidator;

/**
 * Class RelacaoTrabalhoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class RelacaoTrabalhoRepositoryEloquent extends BaseRepository implements RelacaoTrabalhoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RelacaoTrabalho::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RelacaoTrabalhoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
