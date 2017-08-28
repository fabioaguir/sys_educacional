<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\FrequenciaRepository;
use SerEducacional\Entities\Frequencia;

/**
 * Class FrequenciaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class FrequenciaRepositoryEloquent extends BaseRepository implements FrequenciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Frequencia::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
