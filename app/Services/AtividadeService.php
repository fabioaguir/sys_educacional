<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\AtividadeRepository;
use SerEducacional\Entities\Atividade;

class AtividadeService
{
    use TraitService;

    /**
     * @var AtividadeRepository
     */
    private $repository;

    /**
     * @param AtividadeRepository $repository
     */
    public function __construct(AtividadeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return AtividadeRepository
     * @throws \Exception
     */
    public function store(array $data) : Atividade
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $atividade =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$atividade) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $atividade;
    }

    /**
     * @param array $data
     * @param int $id
     * @return AtividadeRepository
     * @throws \Exception
     */
    public function update(array $data, int $id) : Atividade
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $atividade = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$atividade) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $atividade;
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
        $atividade = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$atividade) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $atividade;
    }


}