<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\TelefoneRepository;
use SerEducacional\Entities\Telefone;

class TelefoneService
{
    use TraitService;

    /**
     * @var TelefoneRepository
     */
    private $repository;

    /**
     * @param TelefoneRepository $repository
     */
    public function __construct(TelefoneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return TelefoneRepository
     * @throws \Exception
     */
    public function store(array $data) : Telefone
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $telefone =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$telefone) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $telefone;
    }

    /**
     * @param array $data
     * @param int $id
     * @return TelefoneRepository
     * @throws \Exception
     */
    public function update(array $data, int $id) : Telefone
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $telefone = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$telefone) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $telefone;
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
        $evento = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$evento) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $evento;
    }


}