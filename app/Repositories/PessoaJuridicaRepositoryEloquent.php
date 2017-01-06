<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\PessoaJuridicaRepository;
use SerEducacional\Entities\PessoaJuridica;
use SerEducacional\Validators\PessoaJuridicaValidator;

/**
 * Class PessoaFisicaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class PessoaJuridicaRepositoryEloquent extends BaseRepository implements PessoaJuridicaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PessoaJuridica::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
