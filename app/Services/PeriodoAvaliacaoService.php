<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\PeriodoAvaliacaoRepository;
use SerEducacional\Entities\PeriodoAvaliacao;

class PeriodoAvaliacaoService
{
    use TraitService;

    /**
     * @var PeriodoAvaliacaoRepository
     */
    private $repository;

    /**
     * @param PeriodoAvaliacaoRepository $repository
     */
    public function __construct(PeriodoAvaliacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return PeriodoAvaliacao
     * @throws \Exception
     */
    public function store(array $data) : PeriodoAvaliacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $periodo =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$periodo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $periodo;
    }

    /**
     * @param array $data
     * @param int $id
     * @return PeriodoAvaliacao
     * @throws \Exception
     */
    public function update(array $data, int $id) : PeriodoAvaliacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $periodo = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$periodo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $periodo;
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