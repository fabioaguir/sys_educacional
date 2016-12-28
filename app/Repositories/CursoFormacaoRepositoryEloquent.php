<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\CursoFormacaoRepository;
use SerEducacional\Entities\CursoFormacao;
use SerEducacional\Validators\CursoFormacaoValidator;

/**
 * Class CursoFormacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class CursoFormacaoRepositoryEloquent extends BaseRepository implements CursoFormacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CursoFormacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CursoFormacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
