<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\QuantidadeAtividadeRepository;
use SerEducacional\Entities\QuantidadeAtividade;
use SerEducacional\Validators\QuantidadeAtividadeValidator;

/**
 * Class QuantidadeAtividadeRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class QuantidadeAtividadeRepositoryEloquent extends BaseRepository implements QuantidadeAtividadeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return QuantidadeAtividade::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
