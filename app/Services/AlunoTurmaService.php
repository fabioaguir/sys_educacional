<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\HistoricoRepository;
use SerEducacional\Entities\Historico;

class AlunoTurmaService
{
    use TraitService;

    /**
     * @var HistoricoRepository
     */
    private $repository;

    /**
     * @param HistoricoRepository $repository
     */
    public function __construct(HistoricoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Historico
     * @throws \Exception
     */
    public function store(array $data)
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        # pegando a turma selecionada
        $turma = \DB::table('edu_turmas')
            ->where('edu_turmas.id', '=', $data['turma_id'])
            ->select([
                'serie_id',
                'escola_id'
            ])->first();

        # pega a quantidade de alunos matrículados nessa turma
        $qtdAlunoTurma = \DB::table('edu_historico')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_historico.turma_id')
            ->groupBy('edu_turmas.id')
            ->where('edu_turmas.id', '=', $data['turma_id'])
            ->select([
                \DB::raw('count(edu_historico.id) as qtdAlunos'),
                //'edu_turmas.vagas'
            ])->first();

        if ($qtdAlunoTurma) {

            // Valida se a quantidade de vagas foi esgotada
            if($qtdAlunoTurma->qtdAlunos >= $data['vagas']) {
                return ['retorno' => false, 'resposta' => 'Limte de vagas foi atingido!'];
            }

        }

        # gerando o número de matrícula
        $date = new \DateTime('now');
        $numMatricula = $date->format('YmdHis');

        $dados['matricula'] = $numMatricula;
        $dados['data_matricula'] = $date->format('Y-m-d');
        $dados['aluno_id'] = $data['aluno_id'];
        $dados['serie_id'] = $turma->serie_id;
        $dados['turma_id'] = $data['turma_id'];
        $dados['escola_id'] = $turma->escola_id;
        $dados['situacao_matricula_id'] = '1';

        #Salvando o registro pincipal
        $matricula =  $this->repository->create($dados);

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