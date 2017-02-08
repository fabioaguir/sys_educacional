<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\NivelEnsinoRepository;
use SerEducacional\Entities\NivelEnsino;
use SerEducacional\Validators\NivelEnsinoValidator;

/**
 * Class NivelEnsinoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class NivelEnsinoRepositoryEloquent extends BaseRepository implements NivelEnsinoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NivelEnsino::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
