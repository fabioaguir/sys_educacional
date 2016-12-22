<?php

namespace SerEducacional\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SerEducacional\Repositories\NivelAlfabetizacaoRepository;
use SerEducacional\Entities\NivelAlfabetizacao;
use SerEducacional\Validators\NivelAlfabetizacaoValidator;

/**
 * Class NivelAlfabetizacaoRepositoryEloquent
 * @package namespace SerEducacional\Repositories;
 */
class NivelAlfabetizacaoRepositoryEloquent extends BaseRepository implements NivelAlfabetizacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NivelAlfabetizacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
