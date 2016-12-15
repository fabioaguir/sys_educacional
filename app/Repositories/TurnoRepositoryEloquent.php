<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\TurnoRepository;
use SerEducacional\Entities\Turno;
use SerEducacional\Validators\TurnoValidator;

/**
 * Class TurnoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class TurnoRepositoryEloquent extends BaseRepository implements TurnoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Turno::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
