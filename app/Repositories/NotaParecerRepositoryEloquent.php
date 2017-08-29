<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\NotaParecerRepository;
use SerEducacional\Entities\NotaParecer;
use SerEducacional\Validators\NotaParecerValidator;

/**
 * Class AlocacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class NotaParecerRepositoryEloquent extends BaseRepository implements NotaParecerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NotaParecer::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
