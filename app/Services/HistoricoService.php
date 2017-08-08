<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\HistoricoRepository;
use SerEducacional\Entities\Historico;

class HistoricoService
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

        $historico = "";

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

            // Pega as vagas restantes
            $vagasRestantes = $data['vagas'] - $qtdAlunoTurma->qtdAlunos;

            // Valida se a quantidade de alunos a serem matriculados ultrapassa o limite de vagas
            if(count($data['alunos']) > $vagasRestantes) {
                return ['retorno' => false, 'resposta' => 'A quantidade de alunos ultrapassa o limte de vagas!'];
            }

        }

        // Varrendos todos os alunos a serem matriculados e realizando a matrícula
        foreach ($data['alunos'] as $aluno) {

            # gerando o número de matrícula
            $date = new \DateTime('now');
            $numMatricula = $date->format('YmdHis');

            $dados['matricula'] = $numMatricula;
            $dados['data_matricula'] = $date->format('Y-m-d');
            $dados['aluno_id'] = $aluno;
            $dados['serie_id'] = $data['serie_id'];
            $dados['turma_id'] = $data['turma_id'];
            $dados['escola_id'] = $data['escola_id'];
            $dados['situacao_matricula_id'] = '1';

            #Salvando o registro pincipal
            $historico = $this->repository->create($dados);

        }

        #Verificando se foi criado no banco de dados
        if(!$historico) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return ['retorno' => true, 'resposta' => $historico];
    }


    /**
     * @param array $data
     * @return Historico
     * @throws \Exception
     */
    public function storeUnico(array $data)
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
     * @return Historico
     * @throws \Exception
     */
    public function update(array $data, int $id) : Historico
    {
        # Regras de negócios
        $this->tratamentoCampos($data);

        #Atualizando no banco de dados
        $historico = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$historico) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $historico;
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
        $historico = $this->repository->find($id);

        #Verificando se o registro foi encontrado
        if(!$historico) {
            throw new \Exception('Pessoa não encontrada!');
        }

        #retorno
        return $historico;
    }


}