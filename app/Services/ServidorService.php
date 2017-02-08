<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\ServidorRepository;
use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Entities\Servidor;

class ServidorService
{

    use TraitService;
    
    /**
     * @var PessoaFisicaRepository|ServidorRepository
     */
    private $repository;

    /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;

    /**
     * @var PessoaFisicaRepository
     */
    private $pessoaFisicaRepository;

    /**
     * ServidorService constructor.
     * @param ServidorRepository $repository
     * @param EnderecoRepository $enderecoRepository
     * @param PessoaFisicaRepository $pessoaFisicaRepository
     */
    public function __construct(ServidorRepository $repository,
                                EnderecoRepository $enderecoRepository,
                                PessoaFisicaRepository $pessoaFisicaRepository)
    {
        $this->repository = $repository;
        $this->enderecoRepository = $enderecoRepository;
        $this->pessoaFisicaRepository = $pessoaFisicaRepository;
    }
    
    /**
     * @param $data
     * @return mixed
     */
    public function tratamentoEndereco($data)
    {
        $dados = $data;

        $endereco = $this->enderecoRepository->create($dados);

        return $endereco;
    }

    /**
     * @param array $data
     * @return PessoaFisica
     * @throws \Exception
     */
    public function store(array $data) : Servidor
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Retorno de endereço
        $endereco = $this->tratamentoEndereco($data['cgm']['endereco']);

        # Recuperando instituição
        $instituicao = \DB::table('instituicao')->first();

        #criando vinculo
        $data['cgm']['endereco_id'] = $endereco->id;

        #Salvando o registro cgm
        $cgm =  $this->pessoaFisicaRepository->create($data['cgm']);

        #criando vinculo
        $data['id_instituicao'] = $instituicao->id;
        $data['id_cgm'] = $cgm->id;

        #Salvando o registro principal
        $servidor =  $this->repository->create($data);
        //dd($servidor);
        #Verificando se foi criado no banco de dados
        if(!$servidor) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $servidor;
    }

    /**
     * @param array $data
     * @param int $id
     * @return ConvenioCallCenter
     * @throws \Exception
     */
    public function update(array $data, int $id) : Servidor
    {
        #Atualizando no banco de dados servidor
        $servidor = $this->repository->update($data, $id);

        #Atualizando no banco de dados cgm
        $cgm = $this->pessoaFisicaRepository->update($data['cgm'], $servidor->id_cgm);

        #Atualizando no banco de dados endereço
        $endereco = $this->enderecoRepository->update($data['cgm']['endereco'], $cgm->endereco_id);

        #Verificando se foi atualizado no banco de dados
        if(!$servidor) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $servidor;
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