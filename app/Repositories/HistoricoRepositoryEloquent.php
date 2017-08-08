<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Entities\Historico;
use SerEducacional\Repositories\HistoricoRepository;

/**
 * Class AlocacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class HistoricoRepositoryEloquent extends BaseRepository implements HistoricoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Historico::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
