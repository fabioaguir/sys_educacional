<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\TipoEventoRepository;
use SerEducacional\Entities\TipoEvento;

class TipoEventoService
{
    use TraitService;
    
    /**
     * @var TipoEventoRepository
     */
    private $repository;

    /**
     * @param TipoEventoRepository $repository
     */
    public function __construct(TipoEventoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return TipoEvento
     * @throws \Exception
     */
    public function store(array $data) : TipoEvento
    {        
        #Salvando o registro pincipal
        $tipo =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$tipo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $tipo;
    }

    /**
     * @param array $data
     * @param int $id
     * @return TipoEvento
     * @throws \Exception
     */
    public function update(array $data, int $id) : TipoEvento
    {
        #Atualizando no banco de dados
        $tipo = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$tipo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $tipo;
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