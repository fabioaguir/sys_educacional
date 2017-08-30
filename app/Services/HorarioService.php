<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\HorarioRepository;
use SerEducacional\Entities\Horario;

class HorarioService
{
    use TraitService;

    /**
     * @var HorarioRepository
     */
    private $repository;

    /**
     * @param HorarioRepository $repository
     */
    public function __construct(HorarioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Horario
     * @throws \Exception
     */
    public function store(array $data) : Horario
    {

        // Anulando o campo disciplina caso seja praa turma de 1 ao 5 ano
        if ($data['tipo_turma'] == '2') {
            $data['disciplinas_id'] = null;
        }

        # Regras de negócios
        $this->tratamentoCampos($data);

        #Salvando o registro pincipal
        $horario =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$horario) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $horario;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Horario
     * @throws \Exception
     */
    public function update(array $data, int $id) : Horario
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $horario = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$horario) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $horario;
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
        #Recuperando o registro no banco de dados
        $horario = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$horario) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $horario;
    }


}