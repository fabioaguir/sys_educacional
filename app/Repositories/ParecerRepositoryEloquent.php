<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\ParecerRepository;
use SerEducacional\Entities\Parecer;
use SerEducacional\Validators\ParecerValidator;

/**
 * Class ParecerRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class ParecerRepositoryEloquent extends BaseRepository implements ParecerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Parecer::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
