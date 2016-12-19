<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Repositories\CurriculoRepository;
use SerEducacional\Repositories\DisciplinaRepository;
use Yajra\Datatables\Datatables;

class CurriculoDisciplinaController extends Controller
{
    /**
     * @var CurriculoRepository
     */
    private $curriculoRepository;

    /**
     * @var DisciplinaRepository
     */
    private $disciplinaRepository;

    /**
     * CurriculoDisciplinaController constructor.
     * @param CurriculoRepository $curriculoRepository
     * @param DisciplinaRepository $disciplinaRepository
     */
    public function __construct(CurriculoRepository $curriculoRepository, DisciplinaRepository $disciplinaRepository)
    {
        $this->curriculoRepository = $curriculoRepository;
        $this->disciplinaRepository = $disciplinaRepository;
    }

    /**
     * @return mixed
     */
    public function gridSerie($id)
    {
        #Criando a consulta
        $rows = \DB::table('series')
            ->join('curriculos_series', 'curriculos_series.serie_id', '=', 'series.id')
            ->join('curriculos', 'curriculos.id', '=', 'curriculos_series.curriculo_id')
            ->select([
                 'series.id',
                 'series.nome',
                 'curriculos_series.id as curriculoSerieId'
            ])
            ->where('curriculos.id', $id);

        #Editando a grid
        return Datatables::of($rows)->make(true);
    }

    /**
     * @return mixed
     */
    public function grid($idCurriculoSerie)
    {
        #Criando a consulta
        $rows = \DB::table('disciplinas')
            ->join('curriculos_series_disciplinas', 'curriculos_series_disciplinas.disciplina_id', '=', 'disciplinas.id')
            ->join('curriculos_series', 'curriculos_series.id', '=', 'curriculos_series_disciplinas.curriculo_serie_id')
            ->select([
                'disciplinas.id',
                'disciplinas.nome',
                'disciplinas.codigo',
                'curriculos_series_disciplinas.id as idCurriculoSerieDisciplina'
            ])
            ->where('curriculos_series.id', $idCurriculoSerie);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # variáveis de uso
            $html = '';

            # Verifica a se a condição é válida
            if(true) {
                $html .= '<a href="#" class="removerDisciplina btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # retorno
            return $html;
        })->make(true);
    }


    /**
     * @param Request $request
     * @return array
     */
    public function disciplinasSelect2(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados  = $request->all();
            $result = [];

            # Dados individuais
            $idCurriculoSerie = $dados['idCurriculoSerie'];
            $valueSearch = $dados['search'] ?? "";
            $pageValue   = $dados['page'];

            # QUery Principal
            $query = \DB::table('disciplinas')
                ->whereNotIn('disciplinas.id', function ($where) use ($idCurriculoSerie) {
                   $where->from('disciplinas')
                       ->select('disciplinas.id')
                       ->join('curriculos_series_disciplinas', 'curriculos_series_disciplinas.disciplina_id', '=', 'disciplinas.id')
                       ->join('curriculos_series', 'curriculos_series.id', '=', 'curriculos_series_disciplinas.curriculo_serie_id')
                       ->where('curriculos_series.id', $idCurriculoSerie);
                })
                ->select([
                    'disciplinas.id',
                    'disciplinas.nome'
                ]);

            # Validando o valor da pesquisa
            if(!empty($valueSearch)) {
                $query->where('disciplinas.nome', 'like', "%$valueSearch%");
            }

            # Recuperando todos os registros da consulta
            $resultTotal = $query->get();

            #Calculando a paginação
            $pageValue = $pageValue == 1 ? 0 : ($pageValue * 5) - 5;
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
                'more' => ($pageValue + 5) < count($resultTotal)
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
    public function adicionarDisciplina(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['curriculoSerieId']) && !isset($dados['idDisciplinas'])
                && !isset($dados['idSerie'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $curriculo = $this->curriculoRepository->find($dados['idCurriculo']);

            #Percorrendo os id das disciplinas
            foreach($dados['idDisciplinas'] as $id) {
                #Recuperando a entidade
                $disciplina = $this->disciplinaRepository->find($id);

                #Válidando a disciplina
                if(!$disciplina) {
                    return new \Exception("Disciplina não existe");
                }

                #Adicionando a entidade principal
                $curriculo->series()->find($dados['idSerie'])->pivot->disciplinas()->attach($disciplina->id);
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
    public function removerDisciplina(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idCurriculoSerieDisciplina'])) {
                return new \Exception("Parâmetros inválidos");
            }

            # Removendo a disciplina
            \DB::table('curriculos_series_disciplinas')->where('id', $dados['idCurriculoSerieDisciplina'])->delete();

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
