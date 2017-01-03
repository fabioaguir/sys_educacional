<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\ProcedimentoRepository;
use SerEducacional\Entities\Procedimento;
use SerEducacional\Validators\ProcedimentoValidator;

/**
 * Class ProcedimentoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class ProcedimentoRepositoryEloquent extends BaseRepository implements ProcedimentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Procedimento::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
