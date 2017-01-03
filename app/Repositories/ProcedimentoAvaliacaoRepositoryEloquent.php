<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\ProcedimentoAvaliacaoRepository;
use SerEducacional\Entities\ProcedimentoAvaliacao;
use SerEducacional\Validators\ProcedimentoAvaliacaoValidator;

/**
 * Class ProcedimentoAvaliacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class ProcedimentoAvaliacaoRepositoryEloquent extends BaseRepository implements ProcedimentoAvaliacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProcedimentoAvaliacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProcedimentoAvaliacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
