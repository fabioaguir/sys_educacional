<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Entities\PessoaFisica;
use SerEducacional\Validators\PessoaFisicaValidator;

/**
 * Class PessoaFisicaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class PessoaFisicaRepositoryEloquent extends BaseRepository implements PessoaFisicaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PessoaFisica::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    /*public function validator()
    {

        return PessoaFisicaValidator::class;
    }*/


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
