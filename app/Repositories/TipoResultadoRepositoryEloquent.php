<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\TipoResultadoRepository;
use SerEducacional\Entities\TipoResultado;
use SerEducacional\Validators\TipoResultadoValidator;

/**
 * Class TipoResultadoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class TipoResultadoRepositoryEloquent extends BaseRepository implements TipoResultadoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoResultado::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
