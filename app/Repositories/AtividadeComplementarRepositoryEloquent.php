<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\AtividadeComplementarRepository;
use SerEducacional\Entities\AtividadeComplementar;
use SerEducacional\Validators\AtividadeComplementarValidator;

/**
 * Class AtividadeComplementarRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class AtividadeComplementarRepositoryEloquent extends BaseRepository implements AtividadeComplementarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AtividadeComplementar::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
