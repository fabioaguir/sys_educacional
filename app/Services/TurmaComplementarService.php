<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\TurmaComplementarRepository;
use SerEducacional\Entities\TurmaComplementar;

class TurmaComplementarService
{
    use TraitService;
    
    /**
     * @var TurmaComplementarRepository
     */
    private $repository;

    /**
     * @param TurmaComplementarRepository $repository
     */
    public function __construct(TurmaComplementarRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return TurmaComplementar
     * @throws \Exception
     */
    public function store(array $data) : TurmaComplementar
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        # Definindo o tipo da turma
        $data['tipo_turma_id'] = 2;

        #Salvando o registro pincipal
        $turma =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$turma) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $turma;
    }

    /**
     * @param array $data
     * @param int $id
     * @return TurmaComplementar
     * @throws \Exception
     */
    public function update(array $data, int $id) : TurmaComplementar
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        # Definindo o tipo da turma
        $data['tipo_turma_id'] = 2;
        
        #Atualizando no banco de dados
        $turma = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$turma) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $turma;
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