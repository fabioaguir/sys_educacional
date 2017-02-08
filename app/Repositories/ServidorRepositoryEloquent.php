<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Entities\Servidor;
use SerEducacional\Validators\ServidorValidator;

/**
 * Class ServidorRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class ServidorRepositoryEloquent extends BaseRepository implements ServidorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Servidor::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
