<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Entities\Aluno;

class AlunoService
{
    use TraitService;
    
    /**
     * @var CargoRepository
     */
    private $repository;

    /**
     * @param CargoRepository $repository
     */
    public function __construct(CargoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Cargo
     * @throws \Exception
     */
    public function store(array $data) : Cargo
    {        
        #Salvando o registro pincipal
        $cargo =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$cargo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $cargo;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Cargo
     * @throws \Exception
     */
    public function update(array $data, int $id) : Cargo
    {
        #Atualizando no banco de dados
        $cargo = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$cargo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $cargo;
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