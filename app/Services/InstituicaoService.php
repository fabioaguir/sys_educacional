<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\InstituicaoRepository;
use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Entities\Instituicao;

class InstituicaoService
{
    use TraitService;

    /**
     * @var InstituicaoRepository
     */
    private $repository;

    /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;
    

    /**
     * InstituicaoService constructor.
     * @param InstituicaoRepository $repository
     * @param EnderecoRepository $enderecoRepository
     */
    public function __construct(InstituicaoRepository $repository,
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

        $relacao = [
            'endereco.bairro.cidade.estado',
        ];

        #Recuperando o registro no banco de dados
        $instituicao = $this->repository->with($relacao)->find($id);

        #Verificando se o registro foi encontrado
        if(!$instituicao) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $instituicao;
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
     * @return Instituicao
     * @throws \Exception
     */
    public function store(array $data) : Instituicao
    {
        #Retorno de metodos envolvidos
        $endereco = $this->tratamentoEndereco($data);

        #criando vinculo
        $data['endereco_id'] = $endereco->id;

        #Salvando o registro pincipal
        $instituicao =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$instituicao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $instituicao;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Instituicao
     * @throws \Exception
     */
    public function update(array $data, int $id) : Instituicao
    {
        // Busca instituição
        $findInstituicao = $this->repository->find($id);

        // Busca endereco
        $findEndereco = \DB::table('gen_endereco')->where('id', '=', $findInstituicao->endereco_id)->first();


        if ($findEndereco) {

            #Buscando e atualizando registro de endereço
            $endereco = $this->enderecoRepository->update($data['endereco'], $findInstituicao->endereco_id);
        } else {
            $endereco = $this->enderecoRepository->create($data['endereco']);

            #criando vinculo
            $data['endereco_id'] = $endereco->id;
        }

        #Atualizando no banco de dados
        $instituicao = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$instituicao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $instituicao;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        #Buscando pessoa fisica (tabela cgm)
        $instituicao = $this->repository->find($id);
        
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