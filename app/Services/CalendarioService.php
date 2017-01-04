<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\CalendarioRepository;
use SerEducacional\Entities\Calendario;

class CalendarioService
{
    use TraitService;

    /**
     * @var CalendarioRepository
     */
    private $repository;

    /**
     * @param CalendarioRepository $repository
     */
    public function __construct(CalendarioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Calendario
     * @throws \Exception
     */
    public function store(array $data) : Calendario
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $calendario =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$calendario) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $calendario;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Calendario
     * @throws \Exception
     */
    public function update(array $data, int $id) : Calendario
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $calendario = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$calendario) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $calendario;
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