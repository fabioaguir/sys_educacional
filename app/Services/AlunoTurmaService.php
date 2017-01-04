<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\AlunoTurmaRepository;
use SerEducacional\Entities\AlunoTurma;

class AlunoTurmaService
{
    use TraitService;

    /**
     * @var AlunoTurmaRepository
     */
    private $repository;

    /**
     * @param AlunoTurmaRepository $repository
     */
    public function __construct(AlunoTurmaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return AlunoTurma
     * @throws \Exception
     */
    public function store(array $data) : AlunoTurma
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        # gerando o número de matrícula
        $date = new \DateTime('now');
        $numMatricula = $date->format('YmdHis');
        $data['matricula'] = $numMatricula;

        #Salvando o registro pincipal
        $matricula =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$matricula) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $matricula;
    }

    /**
     * @param array $data
     * @param int $id
     * @return AlunoTurma
     * @throws \Exception
     */
    public function update(array $data, int $id) : AlunoTurma
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $matricula = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$matricula) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $matricula;
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

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $matricula = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$matricula) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $matricula;
    }


}