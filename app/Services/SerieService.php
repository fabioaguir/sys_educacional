<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\SerieRepository;
use SerEducacional\Entities\Serie;

class SerieService
{
    use TraitService;
    
    /**
     * @var SerieRepository
     */
    private $repository;

    /**
     * @param SerieRepository $repository
     */
    public function __construct(SerieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Cargo
     * @throws \Exception
     */
    public function store(array $data) : Serie
    {        
        #Salvando o registro pincipal
        $serie =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$serie) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $serie;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Cargo
     * @throws \Exception
     */
    public function update(array $data, int $id) : Serie
    {
        #Atualizando no banco de dados
        $serie = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$serie) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $serie;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        #deletando o curso
        $result = $this->repository->delete($id);

        # Verificando se a execução foi bem sucessida
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao tentar remover o curso!');
        }

        #retorno
        return true;
    }
}