<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\ProcedimentoRepository;
use SerEducacional\Entities\Procedimento;

class ProcedimentoService
{
    use TraitService;
    
    /**
     * @var ProcedimentoRepository
     */
    private $repository;

    /**
     * @param ProcedimentoRepository $repository
     */
    public function __construct(ProcedimentoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Procedimento
     * @throws \Exception
     */
    public function store(array $data) : Procedimento
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
     * @return Procedimento
     * @throws \Exception
     */
    public function update(array $data, int $id) : Procedimento
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