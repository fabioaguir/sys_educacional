<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\ModalidadeRepository;
use SerEducacional\Entities\Modalidade;
use SerEducacional\Validators\ModalidadeValidator;

/**
 * Class ModalidadeRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class ModalidadeEnsinoRepositoryEloquent extends BaseRepository implements ModalidadeEnsinoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ModalidadeEnsino::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
