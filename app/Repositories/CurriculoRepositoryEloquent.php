<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\CurriculoRepository;
use SerEducacional\Entities\Curriculo;
use SerEducacional\Validators\CurriculoValidator;

/**
 * Class CurriculoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class CurriculoRepositoryEloquent extends BaseRepository implements CurriculoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Curriculo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CurriculoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
