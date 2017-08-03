<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Repositories\TurmaComplementarRepository;
use Yajra\Datatables\Datatables;

class TurmaComplementarAlunoController extends Controller
{
    /**
     * @var TurmaComplementarRepository
     */
    private $turmaComplementarRepository;

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    /**
     * TurmaComplementarAlunoController constructor.
     * @param TurmaComplementarRepository $turmaComplementarRepository
     * @param AlunoRepository $alunoRepository
     */
    public function __construct(TurmaComplementarRepository $turmaComplementarRepository,
                                AlunoRepository $alunoRepository)
    {
        $this->turmaComplementarRepository = $turmaComplementarRepository;
        $this->alunoRepository = $alunoRepository;
    }

    /**
     * @return mixed
     */
    public function grid($idTurmaComplementar)
    {
        #Criando a consulta
        $rows = \DB::table('edu_alunos_turmas_complementares')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_alunos_turmas_complementares.turma_complementar_id')
            ->join('edu_alunos', 'edu_alunos.id', '=', 'edu_alunos_turmas_complementares.aluno_id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->join('edu_alunos_turmas', function ($join) {
                $join->on(
                    'edu_alunos_turmas.id', '=',
                    \DB::raw('(SELECT turma_atual.id FROM edu_alunos_turmas as turma_atual
                        where turma_atual.alunos_id = edu_alunos.id ORDER BY turma_atual.id DESC LIMIT 1)')
                );
            })
            ->select([
                'edu_alunos_turmas_complementares.id',
                'edu_alunos.codigo as matricular',
                'gen_cgm.nome',
                \DB::raw('DATE_FORMAT(edu_alunos_turmas_complementares.data_inclusao, "%d/%m/%Y") as data_inclusao'),
                \DB::raw('DATE_FORMAT(edu_alunos_turmas.data_matricula, "%d/%m/%Y") as data_matricula')
            ])
            ->where('edu_turmas.id', $idTurmaComplementar);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # variáveis de uso
            $html = '';

            # Verifica a se a condição é válida
            if(true) {
                $html .= '<a id="destroyAluno" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # retorno
            return $html;
        })->make(true);
    }


    /**
     * @param Request $request
     * @return array
     */
    public function alunosSelect2(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados  = $request->all();
            $result = [];

            # Dados individuais
            $idTurmaComplementar = $dados['idTurmaComplementar'];
            $valueSearch = $dados['search'] ?? "";
            $pageValue   = $dados['page'];

            # QUery Principal
            $query = \DB::table('edu_alunos')
                ->join('edu_alunos_turmas', function ($join) {
                    $join->on(
                        'edu_alunos_turmas.id', '=',
                        \DB::raw('(SELECT turma_atual.id FROM edu_alunos_turmas as turma_atual
                        where turma_atual.alunos_id = edu_alunos.id ORDER BY turma_atual.id DESC LIMIT 1)')
                    );
                })
                ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
                ->whereNotIn('edu_alunos.id', function ($where) use ($idTurmaComplementar) {
                   $where->from('edu_alunos')
                       ->select('edu_alunos.id')
                       ->join('edu_alunos_turmas_complementares', 'edu_alunos_turmas_complementares.aluno_id', '=', 'edu_alunos.id')
                       ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_alunos_turmas_complementares.turma_complementar_id')
                       ->where('edu_turmas.id', $idTurmaComplementar);
                })
                ->select([
                    'edu_alunos.id',
                    'gen_cgm.nome',
                    'edu_alunos.codigo'
                ]);

            # Validando o valor da pesquisa
            if(!empty($valueSearch)) {
                $query->where('gen_cgm.nome', 'like', "%$valueSearch%");
            }

            # Recuperando todos os registros da consulta
            $resultTotal = $query->get();

            #Calculando a paginação
            $pageValue = $pageValue == 1 ? 0 : ($pageValue * 10) - 10;

            # Fazendo a paginação
            $query->skip($pageValue);
            $query->take(10);

            # Executando e recuperando a query
            $resultItems = $query->get();

            #criando o array de retorno
            foreach($resultItems as $item) {
                $result[] = [
                    "id" => $item->id,
                    "text" => $item->codigo . ' - '. $item->nome
                ];
            }

            # Array de retorno
            $resultRetorno = [
                'data' => $result,
                'more' => ($pageValue + 10) < count($resultTotal)
            ];

            #retorno
            return $resultRetorno;
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Exception
     */
    public function adicionarAluno(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idTurmaComplementar']) && !isset($dados['idAlunos'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $turma = $this->turmaComplementarRepository->find($dados['idTurmaComplementar']);

            #Percorrendo os id dos alunos
            foreach($dados['idAlunos'] as $id) {
                #Recuperando a entidade
                $aluno = $this->alunoRepository->find($id);

                #Válidando o aluno
                if(!$aluno) {
                    return new \Exception("Aluno não existe");
                }

                # Verificando se o aluno já foi cadastrado
                if($turma->alunos()->find($aluno->id)) {
                    continue;
                }

                # Validando pela capacidade máxima
                if(count($turma->alunos) == $turma->vagas) {
                    throw new \Exception('Capacidade máxima atingida');
                }

                # Criando a data atual
                $now = new \DateTime('now');

                #Adicionando a entidade principal
                $turma->alunos()->attach($aluno->id, [
                    'data_inclusao' => $now->format('Y-m-d')
                ]);
            }

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * @return \Exception
     */
    public function removerAluno(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idAlunoTurmaComplementar'])) {
                return new \Exception("Parâmetros inválidos");
            }

            # Removendo a disciplina
            \DB::table('edu_alunos_turmas_complementares')->where('id', $dados['idAlunoTurmaComplementar'])->delete();

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param $idTurmaComplementar
     * @return \Exception
     */
    public function findNumAlunosMatriculados($idTurmaComplementar)
    {
        try {
            #Recuperando a entidade
            $turma = $this->turmaComplementarRepository->find($idTurmaComplementar);

            #Válidando o aluno
            if(!$turma) {
                return new \Exception("Turma não existe");
            }
            
            # Retorno
            return \Illuminate\Support\Facades\Response::json(['valor' => count($turma->alunos)]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
