<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Entities\PessoaFisica;

class PessoaFisicaService
{
    use TraitService;

    /**
     * @var PessoaFisicaRepository
     */
    private $repository;

    /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;

    /**
     * PessoaFisicaService constructor.
     * @param PessoaFisicaRepository $repository
     * @param EnderecoRepository $enderecoRepository
     */
    public function __construct(PessoaFisicaRepository $repository,
                                EnderecoRepository $enderecoRepository)
    {
        $this->repository = $repository;
        $this->enderecoRepository = $enderecoRepository;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $pessoaFisica = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$pessoaFisica) {
            throw new \Exception('Empresa não encontrada!');
        }

        #retorno
        return $pessoaFisica;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function tratamentoEndereco($data)
    {
        $dados = $data['endereco'];
        //dd($dados);
        $endereco = $this->enderecoRepository->create($dados);

        return $endereco;
    }

    /**
     * @param array $data
     * @return PessoaFisica
     * @throws \Exception
     */
    public function store(array $data) : PessoaFisica
    { //dd($data);
        #Retorno de endereço
        $endereco = $this->tratamentoEndereco($data);

        #criando vinculo
        $data['endereco_id'] = $endereco->id;

        #Salvando o registro pincipal
        $pessoaFisica =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$pessoaFisica) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $pessoaFisica;
    }

    /**
     * @param array $data
     * @param int $id
     * @return ConvenioCallCenter
     * @throws \Exception
     */
    public function update(array $data, int $id) : ConvenioCallCenter
    {
        #Atualizando no banco de dados
        $convenioCallCenter = $this->repository->update($data, $id);


        #Verificando se foi atualizado no banco de dados
        if(!$convenioCallCenter) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $convenioCallCenter;
    }
}