<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\HorarioRepository;
use SerEducacional\Entities\Horario;
use SerEducacional\Validators\HorarioValidator;

/**
 * Class HorarioRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class HorarioRepositoryEloquent extends BaseRepository implements HorarioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Horario::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return HorarioValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
