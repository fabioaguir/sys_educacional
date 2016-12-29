<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\PosGraduacaoRepository;
use SerEducacional\Entities\PosGraduacao;
use SerEducacional\Validators\PosGraduacaoValidator;

/**
 * Class PosGraduacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class PosGraduacaoRepositoryEloquent extends BaseRepository implements PosGraduacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PosGraduacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
