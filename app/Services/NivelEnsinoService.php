<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\NivelEnsinoRepository;
use SerEducacional\Entities\NivelEnsino;


class NivelEnsinoService
{
    use TraitService;

    private $repository;

    public function __construct(NivelEnsinoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Funcao
     * @throws \Exception
     */
    public function store(array $data) : NivelEnsino
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $nivelEnsino =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$nivelEnsino) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $nivelEnsino;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Funcao
     * @throws \Exception
     */
    public function update(array $data, int $id) : NivelEnsino
    {
        # Regras de negócios

        #Atualizando no banco de dados
        $funcao = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$funcao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $funcao;
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
        $funcao = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$funcao) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $funcao;
    }


}