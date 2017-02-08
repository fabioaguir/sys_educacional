<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\ControleFrequenciaRepository;
use SerEducacional\Entities\ControleFrequencia;
use SerEducacional\Validators\ControleFrequenciaValidator;

/**
 * Class ControleFrequenciaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class ControleFrequenciaRepositoryEloquent extends BaseRepository implements ControleFrequenciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ControleFrequencia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
