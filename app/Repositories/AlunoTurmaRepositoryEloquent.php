<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\AlunoTurmaRepository;
use SerEducacional\Entities\Historico;
use SerEducacional\Validators\AlunoTurmaValidator;

/**
 * Class AlunoTurmaRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class AlunoTurmaRepositoryEloquent extends BaseRepository implements AlunoTurmaRepository
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
