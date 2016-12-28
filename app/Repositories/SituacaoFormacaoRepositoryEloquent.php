<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\SituacaoFormacaoRepository;
use SerEducacional\Entities\SituacaoFormacao;
use SerEducacional\Validators\SituacaoFormacaoValidator;

/**
 * Class SituacaoFormacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class SituacaoFormacaoRepositoryEloquent extends BaseRepository implements SituacaoFormacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SituacaoFormacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
