<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Repositories\EscolaRepository;
use SerEducacional\Entities\Escola;

class EscolaService
{
    use TraitService;

    /**
     * @var EscolaRepository
     */
    private $repository;

    /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;

    /**
     * EscolaService constructor.
     * @param EscolaRepository $repository
     */
    public function __construct(EscolaRepository $repository,
                                EnderecoRepository $enderecoRepository)
    {
        $this->repository = $repository;
        $this->enderecoRepository = $enderecoRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function tratamentoEndereco($data)
    {
        #Separando dados referente a endereço
        $dados = $data['endereco'];

        #Salvando registro
        $endereco = $this->enderecoRepository->create($dados);

        #Retorno
        return $endereco;
    }

    /**
     * @param array $data
     * @return Escola
     * @throws \Exception
     */
    public function store(array $data) : Escola
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #retorno com objeto endereço
        $endereco = $this->tratamentoEndereco($data);

        #criando vinculo entre escola e endereco
        $data['endereco_id'] = $endereco->id;

        #Salvando o registro pincipal
        $escola =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$escola) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $escola;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Escola
     * @throws \Exception
     */
    public function update(array $data, int $id) : Escola
    {
        /*# Regras de negócios
        $this->tratamentoCampos($data);*/
        //dd($data);
        #Atualizando no banco de dados
        $funcao = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$funcao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $funcao;
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