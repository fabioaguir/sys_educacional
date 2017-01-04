<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\ModalidadeEnsinoRepository;
use SerEducacional\Entities\ModalidadeEnsino;

class ModalidadeEnsinoService
{
    use TraitService;

    /**
     * @var ModalidadeEnsinoRepository
     */
    private $repository;

    public function __construct(ModalidadeEnsinoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return ModalidadeEnsino
     * @throws \Exception
     */
    public function store(array $data) : ModalidadeEnsino
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $modalidadeEnsino =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$modalidadeEnsino) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $modalidadeEnsino;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $funcao = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$funcao) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $funcao;
    }

    public function update(array $data, int $id) : ModalidadeEnsino
    {
        #Atualizando no banco de dados
        $modalidadeEnsino = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$modalidadeEnsino) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $modalidadeEnsino;
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
            throw new \Exception('Ocorreu um erro ao tentar remover a modalidade!');
        }

        #retorno
        return true;
    }
}