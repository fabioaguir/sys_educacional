<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\ConcelhoPedagogicoRepository;
use SerEducacional\Entities\ConcelhoPedagogico;

/**
 * Class AlocacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class ConcelhoPedagogicoRepositoryEloquent extends BaseRepository implements ConcelhoPedagogicoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ConcelhoPedagogico::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
