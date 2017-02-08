<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\AlocacaoRepository;
use SerEducacional\Entities\Alocacao;
use SerEducacional\Validators\AlocacaoValidator;

/**
 * Class AlocacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class AlocacaoRepositoryEloquent extends BaseRepository implements AlocacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Alocacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AlocacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
