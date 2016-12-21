<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Repositories\CursoRepository;
use SerEducacional\Repositories\EscolaRepository;
use SerEducacional\Repositories\TurnoRepository;
use Yajra\Datatables\Datatables;

class EscolaCursoTurnoController extends Controller
{
    /**
     * @var EscolaRepository
     */
    private $escolaRepository;

    /**
     * @var CursoRepository
     */
    private $cursoRepository;

    /**
     * @var TurnoRepository
     */
    private $turnoRepository;

    /**
     * EscolaCursoController constructor.
     * @param EscolaRepository $escolaRepository
     * @param CursoRepository $cursoRepository
     */
    public function __construct(EscolaRepository $escolaRepository,
                                CursoRepository $cursoRepository,
                                TurnoRepository $turnoRepository)
    {
        $this->escolaRepository = $escolaRepository;
        $this->cursoRepository = $cursoRepository;
        $this->turnoRepository = $turnoRepository;
    }

    /**
     * @return mixed
     */
    public function gridTurnos($idEscolaCurso)
    {
        #Criando a consulta
        $rows = \DB::table('turnos')
            ->join('escolas_cursos_turnos', 'escolas_cursos_turnos.turno_id', '=', 'turnos.id')
            ->join('escolas_cursos', 'escolas_cursos.id', '=', 'escolas_cursos_turnos.escola_curso_id')
            ->select([
                'turnos.id',
                'turnos.nome',
                'escolas_cursos_turnos.id as idEscolaCursoTurno'
            ])
            ->where('escolas_cursos.id', $idEscolaCurso);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function () {
            # Html de delete
            $html = '<a style="margin-right: 5%;" title="Remover Turno" id="removerTurno" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

            # Retorno
            return $html;
        })->make(true);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function turnosSelect2(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados  = $request->all();
            $result = [];

            # Dados individuais
            $idEscolaCurso = $dados['idEscolaCurso'];
            $valueSearch   = $dados['search'] ?? "";
            $pageValue     = $dados['page'];
          
            # QUery Principal
            $query = \DB::table('turnos')
                ->whereNotIn('turnos.id', function ($where) use ($idEscolaCurso) {
                    $where->from('turnos')
                        ->select('turnos.id')
                        ->join('escolas_cursos_turnos', 'escolas_cursos_turnos.turno_id', '=', 'turnos.id')
                        ->join('escolas_cursos', 'escolas_cursos.id', '=', 'escolas_cursos_turnos.escola_curso_id')
                        ->where('escolas_cursos.id', $idEscolaCurso);
                })
                ->select([
                    'turnos.id',
                    'turnos.nome'
                ]);

            # Validando o valor da pesquisa
            if(!empty($valueSearch)) {
                $query->where('turnos.nome', 'like', "%$valueSearch%");
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
    public function adicionarTurnos(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idTurnos']) || !isset($dados['idCurso'])
                || !isset($dados['idEscola'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $escola = $this->escolaRepository->find($dados['idEscola']);

            #Percorrendo os id das disciplinas
            foreach($dados['idTurnos'] as $id) {
                #Recuperando a entidade
                $curso = $this->cursoRepository->find($dados['idCurso']);

                #Válidando a disciplina
                if(!$curso) {
                    return new \Exception("Curso não existe");
                }

                #Adicionando a entidade principal
                $escola->cursos()->find($curso->id)->pivot->turnos()->attach($id);
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
    public function removerTurno(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();
            
            #Validando os parametros de entrada
            if(!isset($dados['idEscolaCursoTurno'])) {
                return new \Exception("Parâmetros inválidos");
            }

            # Removendo a disciplina
            \DB::table('escolas_cursos_turnos')->where('id', $dados['idEscolaCursoTurno'])->delete();

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
