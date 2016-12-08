<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\CurriculoRepository;
use SerEducacional\Entities\Curriculo;

class CurriculoService
{
    use TraitService;
    
    /**
     * @var CurriculoRepository
     */
    private $repository;

    /**
     * @param CurriculoRepository $repository
     */
    public function __construct(CurriculoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Curriculo
     * @throws \Exception
     */
    public function store(array $data) : Curriculo
    {
        # Regras de negócios
        $this->tratamentoCampos($data);
        $this->tratamentoAtivo($data);

        #Salvando o registro pincipal
        $curriculo =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$curriculo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $curriculo;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Curriculo
     * @throws \Exception
     */
    public function update(array $data, int $id) : Curriculo
    {
        # Regras de negócios
        $this->tratamentoCampos($data);
        $this->tratamentoAtivo($data);
        
        #Atualizando no banco de dados
        $curriculo = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$curriculo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $curriculo;
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
     * @return mixed
     */
    private function tratamentoAtivo($data)
    {
        # Executando a query
        return \DB::table('curriculos')
            ->where('curso_id', (int) $data['curso_id'])
            ->update(['ativo' => 0]);
    }
}