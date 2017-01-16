<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\DisponibilidadeRepository;
use SerEducacional\Entities\Disponibilidade;

class DisponibilidadeService
{
    use TraitService;

    /**
     * @var DisponibilidadeRepository
     */
    private $repository;

    /**
     * @param DisponibilidadeRepository $repository
     */
    public function __construct(DisponibilidadeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Disponibilidade
     * @throws \Exception
     */
    public function store(array $data) : Disponibilidade
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $disponibilidade =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$disponibilidade) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $disponibilidade;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Disponibilidade
     * @throws \Exception
     */
    public function update(array $data, int $id) : Disponibilidade
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $disponibilidade = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$disponibilidade) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $disponibilidade;
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
        $disponibilidade = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$disponibilidade) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $disponibilidade;
    }


}