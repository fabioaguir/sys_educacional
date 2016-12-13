<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\PessoaJuridicaRepository;
use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Repositories\TelefoneRepository;
use SerEducacional\Entities\PessoaJuridica;

class PessoaJuridicaService
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
    public function __construct(PessoaJuridicaRepository $repository,
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
        $pessoaJuridica = $this->repository->with($relacao)->find($id);
        //dd($pessoaFisica);
        #Verificando se o registro foi encontrado
        if(!$pessoaJuridica) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $pessoaJuridica;
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
        $telefone = $this->telefoneRepository->create($dados);

    }

    /**
     * @param array $data
     * @return PessoaJuridica
     * @throws \Exception
     */
    public function store(array $data) : PessoaJuridica
    {
        #Retorno de metodos envolvidos
        $endereco = $this->tratamentoEndereco($data);

        #criando vinculo
        $data['endereco_id'] = $endereco->id;

        #Salvando o registro pincipal
        $pessoaJuridica =  $this->repository->create($data);

        $idPessoa = $pessoaJuridica->id;

        $this->tratamentoTelefone($data, $idPessoa);

        #Verificando se foi criado no banco de dados
        if(!$pessoaJuridica) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $pessoaJuridica;
    }

    /**
     * @param array $data
     * @param int $id
     * @return PessoaJuridica
     * @throws \Exception
     */
    public function update(array $data, int $id) : PessoaJuridica
    {
        #Atualizando no banco de dados
        $pessoaJuridica = $this->repository->update($data, $id);
        $endereco = $this->enderecoRepository->update($data['endereco'], $id);
        $telefone = $this->telefoneRepository->update($data['telefone'], $id);

        #Verificando se foi atualizado no banco de dados
        if(!$pessoaJuridica) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $pessoaJuridica;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        #Buscando pessoa fisica (tabela cgm)
        $pessoaFisica = $this->repository->find($id);

        #Buscando telefone associado (tabela telefone)
        $telefone = $this->telefoneRepository->findWhere(['cgm_id' => $pessoaFisica->id]);

        #Verificando se existe registro
        if (count($telefone) > 0) {
            #Deletando registro
            $this->telefoneRepository->delete($telefone[0]->id);
        }

        #Apgando registro
        $result = $this->repository->delete($id);

        # Verificando se a execução foi bem sucessida
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao tentar remover o curso!');
        }

        #retorno
        return true;
    }
};