<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\TipoEventoRepository;
use SerEducacional\Entities\TipoEvento;
use SerEducacional\Validators\TipoEventoValidator;

/**
 * Class TipoEventoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class TipoEventoRepositoryEloquent extends BaseRepository implements TipoEventoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoEvento::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoEventoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
