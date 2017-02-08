<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\RelacaoTrabalhoRepository;
use SerEducacional\Entities\RelacaoTrabalho;

class RelacaoTrabalhoService
{
    use TraitService;

    /**
     * @var RelacaoTrabalhoRepository
     */
    private $repository;

    /**
     * @param RelacaoTrabalhoRepository $repository
     */
    public function __construct(RelacaoTrabalhoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return RelacaoTrabalhoRepository
     * @throws \Exception
     */
    public function store(array $data) : RelacaoTrabalho
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $relacao =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$relacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $relacao;
    }

    /**
     * @param array $data
     * @param int $id
     * @return RelacaoTrabalhoRepository
     * @throws \Exception
     */
    public function update(array $data, int $id) : RelacaoTrabalho
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $relacao = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$relacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $relacao;
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
        $relacao = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$relacao) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $relacao;
    }


}