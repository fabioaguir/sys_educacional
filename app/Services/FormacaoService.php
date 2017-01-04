<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\FormacaoRepository;
use SerEducacional\Entities\Formacao;

class FormacaoService
{
    use TraitService;

    /**
     * @var FormacaoRepository
     */
    private $repository;

    /**
     * @param FormacaoRepository $repository
     */
    public function __construct(FormacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return FormacaoRepository
     * @throws \Exception
     */
    public function store(array $data) : Formacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $formacao =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$formacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $formacao;
    }

    /**
     * @param array $data
     * @param int $id
     * @return FormacaoRepository
     * @throws \Exception
     */
    public function update(array $data, int $id) : Formacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $formacao = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$formacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $formacao;
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
        $formacao = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$formacao) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $formacao;
    }


}