<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\DisciplinaRepository;
use SerEducacional\Entities\Disciplina;

class DisciplinaService
{
    use TraitService;
    
    /**
     * @var DisciplinaRepository
     */
    private $repository;

    /**
     * @param DisciplinaRepository $repository
     */
    public function __construct(DisciplinaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Disciplina
     * @throws \Exception
     */
    public function store(array $data) : Disciplina
    {        
        #Salvando o registro pincipal
        $disciplina =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$disciplina) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $disciplina;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Disciplina
     * @throws \Exception
     */
    public function update(array $data, int $id) : Disciplina
    {
        #Atualizando no banco de dados
        $disciplina = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$disciplina) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $disciplina;
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