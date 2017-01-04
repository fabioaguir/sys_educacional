<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\PeriodoAvaliacaoRepository;
use SerEducacional\Entities\PeriodoAvaliacao;
use SerEducacional\Validators\PeriodoAvaliacaoValidator;

/**
 * Class PeriodoAvaliacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class PeriodoAvaliacaoRepositoryEloquent extends BaseRepository implements PeriodoAvaliacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PeriodoAvaliacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PeriodoAvaliacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
