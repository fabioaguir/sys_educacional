<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\LicenciaturaRepository;
use SerEducacional\Entities\Licenciatura;
use SerEducacional\Validators\LicenciaturaValidator;

/**
 * Class LicenciaturaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class LicenciaturaRepositoryEloquent extends BaseRepository implements LicenciaturaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Licenciatura::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
