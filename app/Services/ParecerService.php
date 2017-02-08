<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\ParecerRepository;
use SerEducacional\Entities\Parecer;

class ParecerService
{
    use TraitService;
    
    /**
     * @var ParecerRepository
     */
    private $repository;

    /**
     * @param ParecerRepository $repository
     */
    public function __construct(ParecerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Parecer
     * @throws \Exception
     */
    public function store(array $data) : Parecer
    {        
        #Salvando o registro pincipal
        $parecer =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$parecer) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $parecer;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Parecer
     * @throws \Exception
     */
    public function update(array $data, int $id) : Parecer
    {
        #Atualizando no banco de dados
        $parecer = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$parecer) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $parecer;
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