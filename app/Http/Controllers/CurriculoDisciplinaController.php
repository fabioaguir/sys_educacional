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
    public function grid($id)
    {
        #Criando a consulta
        $rows = \DB::table('disciplinas')
            ->join('curriculos_disciplinas', 'curriculos_disciplinas.disciplinas_id', '=', 'disciplinas.id')
            ->join('curriculos', 'curriculos.id', '=', 'curriculos_disciplinas.curriculos_id')           
            ->select([
                 'disciplinas.id',
                 'disciplinas.nome',
                 'disciplinas.codigo',
                 'curriculos.id as idCurriculo'                    
            ])
            ->where('curriculos.id', $id);

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
            $idCurriculo = $dados['idCurriculo'];
            $valueSearch = $dados['search'] ?? "";
            $pageValue   = $dados['page'];

            # QUery Principal
            $query = \DB::table('disciplinas')
                ->whereNotIn('disciplinas.id', function ($where) use ($idCurriculo) {
                   $where->from('disciplinas')
                       ->select('disciplinas.id')
                       ->join('curriculos_disciplinas', 'curriculos_disciplinas.disciplinas_id', '=', 'disciplinas.id')
                       ->where('curriculos_disciplinas.curriculos_id', $idCurriculo);
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
            if(!isset($dados['idCurriculo']) && !isset($dados['idDisciplinas'])) {
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
                $curriculo->disciplinas()->attach($disciplina->id);
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
            if(!isset($dados['idCurriculo']) && !isset($dados['idDisciplina'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $curriculo = $this->curriculoRepository->find($dados['idCurriculo']);

            #Recuperando a entidade
            $disciplina = $this->disciplinaRepository->find($dados['idDisciplina']);

            #Válidando a disciplina
            if(!$disciplina) {
                return new \Exception("Disciplina não existe");
            }

            #Adicionando a entidade principal
            $curriculo->disciplinas()->detach($disciplina->id);

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
