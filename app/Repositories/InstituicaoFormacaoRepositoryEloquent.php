<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\InstituicaoFormacaoRepository;
use SerEducacional\Entities\InstituicaoFormacao;
use SerEducacional\Validators\InstituicaoFormacaoValidator;

/**
 * Class InstituicaoFormacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class InstituicaoFormacaoRepositoryEloquent extends BaseRepository implements InstituicaoFormacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstituicaoFormacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstituicaoFormacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
