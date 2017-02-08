<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\EventoRepository;
use SerEducacional\Entities\Evento;
use SerEducacional\Validators\EventoValidator;

/**
 * Class EventoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class EventoRepositoryEloquent extends BaseRepository implements EventoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Evento::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EventoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
