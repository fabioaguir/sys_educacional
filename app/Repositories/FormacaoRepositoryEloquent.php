<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\FormacaoRepository;
use SerEducacional\Entities\Formacao;
use SerEducacional\Validators\FormacaoValidator;

/**
 * Class FormacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class FormacaoRepositoryEloquent extends BaseRepository implements FormacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Formacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FormacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
