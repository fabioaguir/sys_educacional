<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Entities\Aluno;

class AlunoService
{
    use TraitService;

    /**
     * @var AlunoRepository|CargoRepository
     */
    private $repository;

    /**
     * AlunoService constructor.
     * @param AlunoRepository $repository
     */
    public function __construct(AlunoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Aluno
     * @throws \Exception
     */
    public function store(array $data) : Aluno
    {        
        #Salvando o registro pincipal
        $aluno =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$aluno) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $aluno;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Aluno
     * @throws \Exception
     */
    public function update(array $data, int $id) : Aluno
    {
        #Atualizando no banco de dados
        $aluno = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$aluno) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $aluno;
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