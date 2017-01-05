<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Repositories\ParecerRepository;
use SerEducacional\Repositories\TurmaRepository;
use Yajra\Datatables\Datatables;

class TurmaParecerController extends Controller
{

    /**
     * @var TurmaRepository
     */
    private $turmaRepository;
    
    /**
     * @var ParecerRepository
     */
    private $parecerRepository;

    /**
     * TurmaParecerController constructor.
     * @param TurmaRepository $turmaRepository
     * @param ParecerRepository $parecerRepository
     */
    public function __construct(TurmaRepository $turmaRepository,
                                ParecerRepository $parecerRepository)
    {
        $this->turmaRepository = $turmaRepository;
        $this->parecerRepository = $parecerRepository;
    }

    /**
     * @return mixed
     */
    public function grid($idTurma)
    {
        #Criando a consulta
        $rows = \DB::table('pareceres')
            ->join('turmas_pareceres', 'turmas_pareceres.parecer_id', '=', 'pareceres.id')
            ->join('turmas', 'turmas.id', '=', 'turmas_pareceres.turma_id')
            ->select([
                'pareceres.id',
                'pareceres.nome',
                'pareceres.codigo',
                'turmas_pareceres.id as idTurmaParecer'
            ])
            ->where('turmas.id', $idTurma);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function () {
            # variáveis de uso
            $html = '';

            # Verifica a se a condição é válida
            if(true) {
                $html .= '<a id="destroyParecer" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # retorno
            return $html;
        })->make(true);;
    }


    /**
     * @param Request $request
     * @return array
     */
    public function parecerSelect2(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados  = $request->all();
            $result = [];

            # Dados individuais
            $idTurma = $dados['idTurma'];
            $valueSearch = $dados['search'] ?? "";
            $pageValue   = $dados['page'];

            # QUery Principal
            $query = \DB::table('pareceres')
                ->whereNotIn('pareceres.id', function ($where) use ($idTurma) {
                   $where->from('pareceres')
                       ->select('pareceres.id')
                       ->join('turmas_pareceres', 'turmas_pareceres.parecer_id', '=', 'pareceres.id')
                       ->join('turmas', 'turmas.id', '=', 'turmas_pareceres.turma_id')
                       ->where('turmas.id', $idTurma);
                })
                ->select([
                    'pareceres.id',
                    'pareceres.nome'
                ]);

            # Validando o valor da pesquisa
            if(!empty($valueSearch)) {
                $query->where('pareceres.nome', 'like', "%$valueSearch%");
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
    public function adicionarParecer(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idTurma']) && !isset($dados['idPareceres'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $turma = $this->turmaRepository->find($dados['idTurma']);

            #Percorrendo os id das disciplinas
            foreach($dados['idPareceres'] as $id) {
                #Recuperando a entidade
                $parecer = $this->parecerRepository->find($id);

                #Válidando a parecer
                if(!$parecer) {
                    return new \Exception("Parecer não existe");
                }

                # Verificando se a parecer já foi cadastrada
                if($turma->pareceres()->find($parecer->id)) {
                    continue;
                }

                #Adicionando a entidade principal
                $turma->pareceres()->attach($parecer->id);
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
    public function removerParecer(Request $request)
    {
        try {
            # Recuperando os dados da requisiçãi
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idTurmaParecer'])) {
                return new \Exception("Parâmetros inválidos");
            }

            # Removendo a disciplina
            \DB::table('turmas_pareceres')->where('id', $dados['idTurmaParecer'])->delete();

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
