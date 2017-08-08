<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\AlunoTurmaRepository;
use SerEducacional\Entities\AlunoTurma;

class MatricularService
{
    use TraitService;

    /**
     * @var AlunoTurmaRepository
     */
    private $repository;

    /**
     * @param AlunoTurmaRepository $repository
     */
    public function __construct(AlunoTurmaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return AlunoTurma
     * @throws \Exception
     */
    public function store(array $data)
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        $matricula = "";

        # pega a quantidade de alunos matrículados nessa turma
        $qtdAlunoTurma = \DB::table('edu_alunos_turmas')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_alunos_turmas.turmas_id')
            ->groupBy('edu_turmas.id')
            ->where('edu_turmas.id', '=', $data['turma_id'])
            ->select([
                \DB::raw('count(edu_alunos_turmas.id) as qtdAlunos'),
                'edu_turmas.vagas'
            ])->first();

        if ($qtdAlunoTurma) {
            // Valida se a quantidade de vagas foi esgotada
            if($qtdAlunoTurma->qtdAlunos >= $qtdAlunoTurma->vagas) {
                return ['retorno' => false, 'resposta' => 'Limte de vagas foi atingido!'];
            }

            // Pega as vagas restantes
            $vagasRestantes = $qtdAlunoTurma->vagas - $qtdAlunoTurma->qtdAlunos;

            // Valida se a quantidade de alunos a serem matriculados ultrapassa o limite de vagas
            if(count($data['dados']) > $vagasRestantes) {
                return ['retorno' => false, 'resposta' => 'A quantidade de alunos ultrapassa o limte de vagas!'];
            }

        }

        // Varrendos todos os alunos a serem matriculados e realizando a matrícula
        foreach ($data['dados'] as $dado) {

            # gerando o número de matrícula
            $date = new \DateTime('now');
            $numMatricula = $date->format('YmdHis');
            $dado['matricula'] = $numMatricula;

            #Salvando o registro pincipal
            $matricula = $this->repository->create($dado);
        }

        #Verificando se foi criado no banco de dados
        if(!$matricula) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return ['retorno' => true, 'resposta' => $matricula];
    }

    /**
     * @param array $data
     * @param int $id
     * @return AlunoTurma
     * @throws \Exception
     */
    public function update(array $data, int $id) : AlunoTurma
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $matricula = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$matricula) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $matricula;
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
        $matricula = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$matricula) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $matricula;
    }


}