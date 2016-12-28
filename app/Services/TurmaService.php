<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\TurmaRepository;
use SerEducacional\Entities\Turma;

class TurmaService
{
    use TraitService;
    
    /**
     * @var TurmaRepository
     */
    private $repository;

    /**
     * @param TurmaRepository $repository
     */
    public function __construct(TurmaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Turma
     * @throws \Exception
     */
    public function store(array $data) : Turma
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $turma =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$turma) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $turma;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Turma
     * @throws \Exception
     */
    public function update(array $data, int $id) : Turma
    {
        # Regras de negócios
        $this->tratamentoCampos($data);
        
        #Atualizando no banco de dados
        $turma = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$turma) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $turma;
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