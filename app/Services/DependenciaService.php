<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\DependenciaRepository;
use SerEducacional\Entities\Dependencia;

class DependenciaService
{
    use TraitService;
    
    /**
     * @var DependenciaRepository
     */
    private $repository;

    /**
     * @param DependenciaRepository $repository
     */
    public function __construct(DependenciaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Dependencia
     * @throws \Exception
     */
    public function store(array $data) : Dependencia
    {        
        #Salvando o registro pincipal
        $dependencia =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$dependencia) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $dependencia;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Dependencia
     * @throws \Exception
     */
    public function update(array $data, int $id) : Dependencia
    {
        #Atualizando no banco de dados
        $dependencia = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$dependencia) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $dependencia;
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