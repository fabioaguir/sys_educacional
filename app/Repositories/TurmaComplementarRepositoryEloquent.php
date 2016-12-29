<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\TurmaComplementarRepository;
use SerEducacional\Entities\TurmaComplementar;
use SerEducacional\Validators\TurmaComplementarValidator;

/**
 * Class TurmaComplementarRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class TurmaComplementarRepositoryEloquent extends BaseRepository implements TurmaComplementarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TurmaComplementar::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
