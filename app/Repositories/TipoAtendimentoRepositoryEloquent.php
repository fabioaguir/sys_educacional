<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\TipoAtendimentoRepository;
use SerEducacional\Entities\TipoAtendimento;
use SerEducacional\Validators\TipoAtendimentoValidator;

/**
 * Class TipoAtendimentoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class TipoAtendimentoRepositoryEloquent extends BaseRepository implements TipoAtendimentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoAtendimento::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
