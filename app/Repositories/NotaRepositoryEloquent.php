<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\NotaRepository;
use SerEducacional\Entities\Nota;
use SerEducacional\Validators\NotaValidator;

/**
 * Class AlocacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class NotaRepositoryEloquent extends BaseRepository implements NotaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Nota::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return NotaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
