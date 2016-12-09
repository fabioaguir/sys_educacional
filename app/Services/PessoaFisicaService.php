<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Repositories\TelefoneRepository;
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
     * @var TelefoneRepository
     */
    private $telefoneRepository;

    /**
     * PessoaFisicaService constructor.
     * @param PessoaFisicaRepository $repository
     * @param EnderecoRepository $enderecoRepository
     */
    public function __construct(PessoaFisicaRepository $repository,
                                EnderecoRepository $enderecoRepository,
                                TelefoneRepository $telefoneRepository)
    {
        $this->repository = $repository;
        $this->enderecoRepository = $enderecoRepository;
        $this->telefoneRepository = $telefoneRepository;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        #Recuperando o registro no banco de dados
        $objPessoaFisica = $this->repository->find($id);

        $relacao = [
            'endereco.bairro.cidade',
            'telefone'
        ];

        #Recuperando o registro no banco de dados
        $pessoaFisica = $this->repository->with($relacao)->find($id);
        //dd($pessoaFisica);
        #Verificando se o registro foi encontrado
        if(!$pessoaFisica) {
            throw new \Exception('Pessoa não encontrada!');
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
        #Separando dados referente a endereço
        $dados = $data['endereco'];

        #Salvando registro
        $endereco = $this->enderecoRepository->create($dados);

        #Retorno
        return $endereco;
    }

    /**
     * @param $data
     * @param $idPessoa
     */
    public function tratamentoTelefone($data, $idPessoa)
    {
        #Separando dados referente a endereço
        $dados = $data['telefone'];

        #Criando vinculo entre telefone e PessoaFisica (tabela cgm)
        $dados['cgm_id'] = $idPessoa;

        #Salvando registro
        $this->telefoneRepository->create($dados);
    }

    /**
     * @param array $data
     * @return PessoaFisica
     * @throws \Exception
     */
    public function store(array $data) : PessoaFisica
    {
        #Retorno de metodos envolvidos
        $endereco = $this->tratamentoEndereco($data);

        #criando vinculo
        $data['endereco_id'] = $endereco->id;

        #Salvando o registro pincipal
        $pessoaFisica =  $this->repository->create($data);

        $idPessoa = $pessoaFisica->id;

        $this->tratamentoTelefone($data, $idPessoa);

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
    public function update(array $data, int $id) : PessoaFisica
    { //dd($id);
        #Atualizando no banco de dados
        $pessoaFisica = $this->repository->update($data, $id);
        $endereco = $this->enderecoRepository->update($data['endereco'], $id);
        $telefone = $this->telefoneRepository->update($data['telefone'], $id);

        #Verificando se foi atualizado no banco de dados
        if(!$pessoaFisica) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $pessoaFisica;
    }
};