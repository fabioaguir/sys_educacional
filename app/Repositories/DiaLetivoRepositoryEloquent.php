<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\DiaLetivoRepository;
use SerEducacional\Entities\DiaLetivo;
use SerEducacional\Validators\DiaLetivoValidator;

/**
 * Class DiaLetivoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class DiaLetivoRepositoryEloquent extends BaseRepository implements DiaLetivoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DiaLetivo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
