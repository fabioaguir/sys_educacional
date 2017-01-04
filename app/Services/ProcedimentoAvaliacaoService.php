<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\ProcedimentoAvaliacaoRepository;
use SerEducacional\Entities\ProcedimentoAvaliacao;

class ProcedimentoAvaliacaoService
{
    use TraitService;
    
    /**
     * @var ProcedimentoAvaliacaoRepository
     */
    private $repository;

    /**
     * @param ProcedimentoAvaliacaoRepository $repository
     */
    public function __construct(ProcedimentoAvaliacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return ProcedimentoAvaliacao
     * @throws \Exception
     */
    public function store(array $data) : ProcedimentoAvaliacao
    {        
        #Salvando o registro pincipal
        $procedimento =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$procedimento) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $procedimento;
    }

    /**
     * @param array $data
     * @param int $id
     * @return ProcedimentoAvaliacao
     * @throws \Exception
     */
    public function update(array $data, int $id) : ProcedimentoAvaliacao
    {
        #Atualizando no banco de dados
        $procedimento = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$procedimento) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $procedimento;
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