<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Repositories\TelefoneRepository;
use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Entities\Aluno;

class AlunoService
{
    use TraitService;

    /**
     * @var AlunoRepository
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
     * @var PessoaFisicaRepository
     */
    private $pessoaFisicaRepository;

    /**
     * AlunoService constructor.
     * @param AlunoRepository $repository
     * @param EnderecoRepository $enderecoRepository
     * @param TelefoneRepository $telefoneRepository
     */
    public function __construct(AlunoRepository $repository,
                                enderecoRepository $enderecoRepository,
                                telefoneRepository $telefoneRepository,
                                PessoaFisicaRepository $pessoaFisicaRepository)
    {
        $this->repository = $repository;
        $this->enderecoRepository = $enderecoRepository;
        $this->telefoneRepository = $telefoneRepository;
        $this->pessoaFisicaRepository = $pessoaFisicaRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function tratamentoEndereco($data)
    {
        #Separando dados referente a endereço
        $dados = $data['cgm']['endereco'];

        #Salvando registro
        $endereco = $this->enderecoRepository->create($dados);
        dd($endereco);
        #Retorno
        return $endereco;
    }

    /**
     * @param $data
     * @param $idPessoa
     */
    public function tratamentoTelefone($data, $pessoaFisica)
    {
        #Criando vinculo entre telefone e PessoaFisica (tabela cgm)
        $data['telefone']['cgm_id'] = $pessoaFisica;

        #Salvando registro
        $this->telefoneRepository->create($data['telefone']);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function tratamentoPessoaFisica($data)
    {
        #Separando dados referente a endereço
        $dados = $data['cgm'];

        #Salvando registro
        $pessoaFisica = $this->pessoaFisicaRepository->create($dados);

        return $pessoaFisica;
    }

    /**
     * @param array $data
     * @return Aluno
     * @throws \Exception
     */
    public function store(array $data) : Aluno
    {
        # Regras de negócios
        $this->tratamentoCampos($data);
        $this->tratamentoCampos($data['cgm']['endereco']);

        #retorno de metodos envolvidos
        $endereco = $this->tratamentoEndereco($data);

        #criando vinculo entre endereço e aluno / cgm e aluno
        $data['cgm']['endereco_id'] = $endereco->id;

        #salvando registro de pessoa
        $pessoaFisica = $this->tratamentoPessoaFisica($data);

        #criando vinculo entre pessoa e aluno
        $data['cgm_id'] = $pessoaFisica->id;

        #Salvando o registro pincipal
        $aluno =  $this->repository->create($data);

        #metodo responsavel por salvar o telefone do aluno
        $this->tratamentoTelefone($data, $pessoaFisica->id);

        #Verificando se foi criado no banco de dados
        if(!$aluno) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $aluno;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Aluno
     * @throws \Exception
     */
    public function update(array $data, int $id) : Aluno
    {
        $this->tratamentoCampos($data);
        $this->tratamentoCampos($data['cgm']['endereco']);

        #Atualizando no banco de dados
        $aluno = $this->repository->update($data, $id);

        #buscando e atualizando registro de pessoa física (tabela cgm)
        $pessoaFisica = $this->pessoaFisicaRepository->find($aluno->cgm_id);
        $this->pessoaFisicaRepository->update($data['cgm'], $pessoaFisica->id);

        #buscando e atualizando registro de endereço (tabela endereco)
        $endereco = $this->enderecoRepository->find($pessoaFisica->endereco_id);
        $this->enderecoRepository->update($data['cgm']['endereco'], $endereco->id);

        #buscando e atualizando registro de telefone (tabela telefones)
        $telefone = $this->telefoneRepository->findWhere(['cgm_id' => $pessoaFisica->id]);
        $dados = $this->telefoneRepository->update($data['telefone'], $telefone[0]->id);

        #Verificando se foi atualizado no banco de dados
        if(!$aluno) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $aluno;
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
        $relacao = [
            'cgm.endereco.bairro.cidade.estado',
            'cgm.telefone'
        ];

        #Recuperando o registro no banco de dados
        $aluno = $this->repository->with($relacao)->find($id);
//dd($aluno);
        #Verificando se o registro foi encontrado
        if(!$aluno) {
            throw new \Exception('Aluno não encontrado!');
        }

        #retorno
        return $aluno;
    }
}