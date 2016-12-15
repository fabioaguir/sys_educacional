<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\InstituicaoRepository;
use SerEducacional\Entities\Instituicao;
use SerEducacional\Validators\InstituicaoValidator;

/**
 * Class InstituicaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class InstituicaoRepositoryEloquent extends BaseRepository implements InstituicaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Instituicao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstituicaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
