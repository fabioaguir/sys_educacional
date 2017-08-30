<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\ConcelhoPedagogicoRepository;
use SerEducacional\Entities\ConcelhoPedagogico;

class ConcelhoPedagogicoService
{
    use TraitService;
    
    /**
     * @var ConcelhoPedagogicoRepository
     */
    private $repository;

    /**
     * @param ConcelhoPedagogicoRepository $repository
     */
    public function __construct(ConcelhoPedagogicoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return ConcelhoPedagogico
     * @throws \Exception
     */
    public function store(array $data) : ConcelhoPedagogico
    {        
        #Salvando o registro pincipal
        $result =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $result;
    }

    /**
     * @param array $data
     * @param int $id
     * @return ConcelhoPedagogico
     * @throws \Exception
     */
    public function update(array $data, int $id) : ConcelhoPedagogico
    {
        #Atualizando no banco de dados
        $result = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $result;
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