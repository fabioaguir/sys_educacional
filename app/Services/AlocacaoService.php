<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\AlocacaoRepository;
use SerEducacional\Entities\Alocacao;

class AlocacaoService
{
    use TraitService;

    /**
     * @var AlocacaoRepository
     */
    private $repository;

    /**
     * @param AlocacaoRepository $repository
     */
    public function __construct(AlocacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return AlocacaoRepository
     * @throws \Exception
     */
    public function store(array $data) : Alocacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $alocacao =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$alocacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $alocacao;
    }

    /**
     * @param array $data
     * @param int $id
     * @return AlocacaoRepository
     * @throws \Exception
     */
    public function update(array $data, int $id) : Alocacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $alocacao = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$alocacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $alocacao;
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
        $alocacao = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$alocacao) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $alocacao;
    }


}