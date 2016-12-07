<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Repositories\EnderecoRepository;
use SerEducacional\Entities\PessoaFisica;

class PessoaFisicaService
{
    /**
     * @var PessoaFisicaRepository
     */
    private $repository;
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

    /**
     * @param array $data
     * @return array
     */
    public function tratamentoCampos(array &$data)
    {
        # Tratamento de campos de chaves estrangeira
        foreach ($data as $key => $value) {
            if(is_array($value)) {
                foreach ($value as $key2 => $value2) {
                    $explodeKey2 = explode("_", $key2);

                    if ($explodeKey2[count($explodeKey2) -1] == "id" && $value2 == null ) {
                        $data[$key][$key2] = null;
                    }
                }
            }

            $explodeKey = explode("_", $key);

            if (in_array('id', $explodeKey) && $value == null ) {
                $data[$key] = null;
            }

            /*if ($explodeKey[count($explodeKey) -1] == "id" && $value == null ) {
                $data[$key] = null;
            }*/
        }

        #Retorno
        return $data;
    }

    /**
     * Método load
     *
     * Método responsável por recuperar todos os models (com seus repectivos
     * métodos personalizados para consulta, se for o caso) do array passado
     * por parâmetro.
     *
     * @param array $models || Melhorar esse código
     * @return array
     */
    public function load(array $models, $ajax = false) : array
    {
        #Declarando variáveis de uso
        $result    = [];
        $expressao = [];

        #Criando e executando as consultas
        foreach ($models as $model) {
            # separando as strings
            $explode   = explode("|", $model);

            # verificando a condição
            if(count($explode) > 1) {
                $model     = $explode[0];
                $expressao = explode(",", $explode[1]);
            }

            #qualificando o namespace
            $nameModel = "\\SerEducacional\\Entities\\$model";

            #Verificando se existe sobrescrita do nome do model
            //$model     = isset($expressao[2]) ? $expressao[2] : $model;

            if ($ajax) {
                if(count($expressao) > 0) {
                    switch (count($expressao)) {
                        case 1 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}()->orderBy('nome', 'asc')->get(['nome', 'id', 'codigo']);
                            break;
                        case 2 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->orderBy('nome', 'asc')->get(['nome', 'id', 'codigo']);
                            break;
                        case 3 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1], $expressao[2])->orderBy('nome', 'asc')->get(['nome', 'id', 'codigo']);
                            break;
                    }

                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::orderBy('nome', 'asc')->get(['nome', 'id']);
                }
            } else {
                if(count($expressao) > 0) {
                    switch (count($expressao)) {
                        case 1 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}()->orderBy('nome', 'asc')->pluck('nome', 'id');
                            break;
                        case 2 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1])->orderBy('nome', 'asc')->pluck('nome', 'id');
                            break;
                        case 3 :
                            #Recuperando o registro e armazenando no array
                            $result[strtolower($model)] = $nameModel::{$expressao[0]}($expressao[1], $expressao[2])->orderBy('nome', 'asc')->pluck('nome', 'id');
                            break;
                    }
                } else {
                    #Recuperando o registro e armazenando no array
                    $result[strtolower($model)] = $nameModel::pluck('nome', 'id');
                }
            }

            # Limpando a expressão
            $expressao = [];
        }

        #retorno
        return $result;
    }
}