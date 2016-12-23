<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\FormaAvaliacaoRepository;
use SerEducacional\Entities\FormaAvaliacao;
use SerEducacional\Validators\FormaAvaliacaoValidator;

/**
 * Class FormaAvaliacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class FormaAvaliacaoRepositoryEloquent extends BaseRepository implements FormaAvaliacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FormaAvaliacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FormaAvaliacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
