<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\EscolaRepository;
use SerEducacional\Entities\Escola;
use SerEducacional\Validators\EscolaValidator;

/**
 * Class EscolaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class EscolaRepositoryEloquent extends BaseRepository implements EscolaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Escola::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
