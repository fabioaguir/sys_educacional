<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\CursoRepository;
use SerEducacional\Entities\Curso;

class CursoService
{
    use TraitService;
    
    /**
     * @var CursoRepository
     */
    private $repository;

    /**
     * @param CursoRepository $repository
     */
    public function __construct(CursoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Curso
     * @throws \Exception
     */
    public function store(array $data) : Curso
    {        
        #Salvando o registro pincipal
        $curso =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$curso) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $curso;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Curso
     * @throws \Exception
     */
    public function update(array $data, int $id) : Curso
    {
        #Atualizando no banco de dados
        $curso = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$curso) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $curso;
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