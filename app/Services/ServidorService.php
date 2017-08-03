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
        $dados = $data['cgm']['endereco'];

        // Validando se o CGM já existe ou não
        if (isset($data['endereco_id']) && $data['endereco_id'] != "") {
            #Editando registro
            $endereco = $this->enderecoRepository->update($dados, $data['endereco_id']);
        } else {
            #Salvando registro
            $endereco = $this->enderecoRepository->create($dados);
        }

        return $endereco;
    }

    /**
     * @param array $data
     * @return Servidor
     * @throws \Exception
     */
    public function store(array $data) : Servidor
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Retorno de endereço
        $endereco = $this->tratamentoEndereco($data);

        # Recuperando instituição
        $instituicao = \DB::table('edu_instituicao')->first();

        #criando vinculo
        $data['cgm']['endereco_id'] = $endereco->id;

        // Validando se o CGM já existe ou não
        if (isset($data['cgm_id']) && $data['cgm_id'] != "") {
            #Editando registro cgm
            $cgm = $this->pessoaFisicaRepository->update($data['cgm'], $data['cgm_id']);
        } else {
            #Salvando registro cgm
            $cgm = $this->pessoaFisicaRepository->create($data['cgm']);
        }

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