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
        $rows = \DB::table('atividades_complementares')
            ->join('turmas_atividades', 'turmas_atividades.atividade_id', '=', 'atividades_complementares.id')
            ->join('turmas', 'turmas.id', '=', 'turmas_atividades.turma_id')
            ->select([
                'atividades_complementares.id',
                'atividades_complementares.nome',
                'atividades_complementares.codigo',
                'turmas_atividades.id as idTurmaAtividade'
            ])
            ->where('turmas.id', $idTurmaComplementar);

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
            $query = \DB::table('atividades_complementares')
                ->whereNotIn('atividades_complementares.id', function ($where) use ($idTurmaComplementar) {
                   $where->from('atividades_complementares')
                       ->select('atividades_complementares.id')
                       ->join('turmas_atividades', 'turmas_atividades.atividade_id', '=', 'atividades_complementares.id')
                       ->join('turmas', 'turmas.id', '=', 'turmas_atividades.turma_id')
                       ->where('turmas.id', $idTurmaComplementar);
                })
                ->select([
                    'atividades_complementares.id',
                    'atividades_complementares.nome'
                ]);

            # Validando o valor da pesquisa
            if(!empty($valueSearch)) {
                $query->where('atividades_complementares.nome', 'like', "%$valueSearch%");
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
            \DB::table('turmas_atividades')->where('id', $dados['idTurmaAtividade'])->delete();

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
