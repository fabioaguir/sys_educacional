<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Repositories\AtividadeComplementarRepository;
use SerEducacional\Repositories\TurmaComplementarRepository;
use Yajra\Datatables\Datatables;

class TurmaComplementarAtividadeController extends Controller
{
    /**
     * @var TurmaComplementarRepository
     */
    private $turmaComplementarRepositoryRepository;

    /**
     * @var AtividadeComplementarRepository
     */
    private $atividadeComplementarRepository;

    /**
     * TurmaComplementarAtividadeController constructor.
     * @param TurmaComplementarRepository $turmaComplementarRepositoryRepository
     * @param AtividadeComplementarRepository $atividadeComplementarRepository
     */
    public function __construct(TurmaComplementarRepository $turmaComplementarRepositoryRepository,
                                AtividadeComplementarRepository $atividadeComplementarRepository)
    {
        $this->turmaComplementarRepositoryRepository = $turmaComplementarRepositoryRepository;
        $this->atividadeComplementarRepository = $atividadeComplementarRepository;
    }

    /**
     * @return mixed
     */
    public function grid($idTurmaComplementar)
    {
        #Criando a consulta
        $rows = \DB::table('edu_atividades_complementares')
            ->join('edu_turmas_atividades', 'edu_turmas_atividades.atividade_id', '=', 'edu_atividades_complementares.id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_turmas_atividades.turma_id')
            ->select([
                'edu_atividades_complementares.id',
                'edu_atividades_complementares.nome',
                'edu_atividades_complementares.codigo',
                'edu_turmas_atividades.id as idTurmaAtividade'
            ])
            ->where('edu_turmas.id', $idTurmaComplementar);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function () {
            # variáveis de uso
            $html = '';

            # Verifica a se a condição é válida
            if(true) {
                $html .= '<a id="destroyAtividade" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # retorno
            return $html;
        })->make(true);;
    }


    /**
     * @param Request $request
     * @return array
     */
    public function atividadeSelect2(Request $request)
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
            $query = \DB::table('edu_atividades_complementares')
                ->whereNotIn('edu_atividades_complementares.id', function ($where) use ($idTurmaComplementar) {
                   $where->from('edu_atividades_complementares')
                       ->select('edu_atividades_complementares.id')
                       ->join('edu_turmas_atividades', 'edu_turmas_atividades.atividade_id', '=', 'edu_atividades_complementares.id')
                       ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_turmas_atividades.turma_id')
                       ->where('edu_turmas.id', $idTurmaComplementar);
                })
                ->select([
                    'edu_atividades_complementares.id',
                    'edu_atividades_complementares.nome'
                ]);

            # Validando o valor da pesquisa
            if(!empty($valueSearch)) {
                $query->where('edu_atividades_complementares.nome', 'like', "%$valueSearch%");
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
                    "text" => $item->nome
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
    public function adicionarAtividade(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idTurmaComplementar']) && !isset($dados['idAtividades'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $turma = $this->turmaComplementarRepositoryRepository->find($dados['idTurmaComplementar']);

            #Percorrendo os id das disciplinas
            foreach($dados['idAtividades'] as $id) {
                #Recuperando a entidade
                $atividade = $this->atividadeComplementarRepository->find($id);

                #Válidando a atividade
                if(!$atividade) {
                    return new \Exception("Atividade não existe");
                }

                # Verificando se a atividade já foi cadastrada
                if($turma->atividades()->find($atividade->id)) {
                    continue;
                }

                #Adicionando a entidade principal
                $turma->atividades()->attach($atividade->id);
            }

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @return \Exception
     */
    public function removerAtividade(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idTurmaAtividade'])) {
                return new \Exception("Parâmetros inválidos");
            }

            # Removendo a disciplina
            \DB::table('edu_turmas_atividades')->where('id', $dados['idTurmaAtividade'])->delete();

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
