<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\FormaAvaliacaoRepository;
use SerEducacional\Entities\FormaAvaliacao;

class FormaAvaliacaoService
{
    use TraitService;
    
    /**
     * @var FormaAvaliacaoRepository
     */
    private $repository;

    /**
     * @param FormaAvaliacaoRepository $repository
     */
    public function __construct(FormaAvaliacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return FormaAvaliacao
     * @throws \Exception
     */
    public function store(array $data) : FormaAvaliacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $formaAvaliacao =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$formaAvaliacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        # Regras de negócios
        $this->tratamentoNiveisAlfabetizacao($data, $formaAvaliacao);

        #Retorno
        return $formaAvaliacao;
    }

    /**
     * @param array $data
     * @param int $id
     * @return FormaAvaliacao
     * @throws \Exception
     */
    public function update(array $data, int $id) : FormaAvaliacao
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $formaAvaliacao = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$formaAvaliacao) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $formaAvaliacao;
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
     * @param $data
     * @param FormaAvaliacao $formaAvaliacao
     * @return bool
     */
    public function tratamentoNiveisAlfabetizacao(&$data, FormaAvaliacao $formaAvaliacao)
    {
        # Validando a entrada
        if(!isset($data['niveis_alfabeizacao']) && empty($data['niveis_alfabeizacao'])) {
            return false;
        }

        # Reuperando os níveis
        $niveis = json_decode($data['niveis_alfabeizacao']);

        # Criando os níveis
        foreach($niveis as $nivel) {
            $formaAvaliacao->niveisAlfabetizacao()->create([
                'codigo' => $nivel->codigo,
                'nome' => $nivel->nome,
                'minimo_aprovacao' => $nivel->minimo,
            ]);
        }

        # Retorno
        return true;
    }
}