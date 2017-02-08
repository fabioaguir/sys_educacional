<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Repositories\CursoRepository;
use SerEducacional\Repositories\EscolaRepository;
use Yajra\Datatables\Datatables;

class EscolaCursoController extends Controller
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
     * EscolaCursoController constructor.
     * @param EscolaRepository $escolaRepository
     * @param CursoRepository $cursoRepository
     */
    public function __construct(EscolaRepository $escolaRepository, CursoRepository $cursoRepository)
    {
        $this->escolaRepository = $escolaRepository;
        $this->cursoRepository = $cursoRepository;
    }

    /**
     * @return mixed
     */
    public function gridCursos($id)
    {
        #Criando a consulta
        $rows = \DB::table('cursos')
            ->join('escolas_cursos', 'escolas_cursos.curso_id', '=', 'cursos.id')
            ->select([
                'cursos.id',
                'cursos.nome',
                'escolas_cursos.id as idEscolaCurso',
                'escolas_cursos.escola_id as idEscola'
            ])
            ->where('escolas_cursos.escola_id', $id);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Html
            $html = '';

            # Recuperando a escola
            $escola = $this->escolaRepository->find($row->idEscola);

            # Regra para possibilidade de exclusão
            if (count($escola->cursos()->find($row->id)->pivot->turnos) == 0) {
                # Html de delete
                $html .= '<a style="margin-right: 5%;" title="Remover Curso" id="removerCurso" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Retorno
            return $html;
        })->make(true);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cursosSelect2(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados  = $request->all();
            $result = [];
       
            # Dados individuais
            $idEscola      = $dados['idEscola'];
            $valueSearch   = $dados['search'] ?? "";
            $pageValue     = $dados['page'];
          
            # QUery Principal
            $query = \DB::table('cursos')
                ->whereNotIn('cursos.id', function ($where) use ($idEscola) {
                    $where->from('cursos')
                        ->select('cursos.id')
                        ->join('escolas_cursos', 'escolas_cursos.curso_id', '=', 'cursos.id')
                        ->where('escolas_cursos.escola_id', $idEscola);
                })
                ->select([
                    'cursos.id',
                    'cursos.nome'
                ]);

            # Validando o valor da pesquisa
            if(!empty($valueSearch)) {
                $query->where('cursos.nome', 'like', "%$valueSearch%");
            }

            # Recuperando todos os registros da consulta
            $resultTotal = $query->get();

            #Calculando a paginação
            $pageValue = $pageValue == 1 ? 0 : ($pageValue * 10) - 10;
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
    public function adicionarCursos(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idCursos']) && !isset($dados['idEscola'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $escola = $this->escolaRepository->find($dados['idEscola']);

            #Percorrendo os id das disciplinas
            foreach($dados['idCursos'] as $id) {
                #Recuperando a entidade
                $curso = $this->cursoRepository->find($id);

                #Válidando a disciplina
                if(!$curso) {
                    return new \Exception("Curso não existe");
                }
 
                #Adicionando a entidade principal
                $escola->cursos()->attach($curso->id);
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
    public function removerCurso(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idEscolaCurso'])) {
                return new \Exception("Parâmetros inválidos");
            }

            # Removendo a disciplina
            \DB::table('escolas_cursos')->where('id', $dados['idEscolaCurso'])->delete();

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
