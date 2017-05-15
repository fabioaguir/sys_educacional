<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\AlunoTurmaCreateRequest;
use SerEducacional\Http\Requests\AlunoTurmaUpdateRequest;
use SerEducacional\Repositories\AlunoTurmaRepository;
use SerEducacional\Validators\AlunoTurmaValidator;
use SerEducacional\Services\MatricularService;
use Yajra\Datatables\Datatables;


class MatricularController extends Controller
{
    /**
     * @var AlunoTurmaRepository
     */
    protected $repository;

    /**
     * @var MatricularService
     */
    private $service;

    /**
     * @var AlunoTurmaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [

    ];

    /**
     * AlunoTurmasController constructor.
     * @param AlunoTurmaRepository $repository
     * @param MatricularService $service
     * @param AlunoTurmaValidator $validator
     */
    public function __construct(AlunoTurmaRepository $repository,
                                MatricularService $service,
                                AlunoTurmaValidator $validator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Retorno para view
        return view('matricular.create');
    }

    /**
     * @return mixed
     */
    public function grid($id)
    {
        #Criando a consulta
        $rows = \DB::table('alunos_turmas')
            ->join('alunos', 'alunos.id', '=', 'alunos_turmas.alunos_id')
            ->join('cgm', 'cgm.id', '=', 'alunos.cgm_id')
            ->join('turmas', 'turmas.id', '=', 'alunos_turmas.turmas_id')
            ->join('escola', 'escola.id', '=', 'turmas.escola_id')
            ->join('cursos', 'cursos.id', '=', 'turmas.curso_id')
            ->join('curriculos', 'curriculos.id', '=', 'turmas.curriculo_id')
            ->join('calendarios', 'calendarios.id', '=', 'turmas.calendario_id')
            ->join('series', 'series.id', '=', 'turmas.serie_id')
            ->join('turnos', 'turnos.id', '=', 'turmas.turno_id')
            ->where('alunos_turmas.turmas_id', '=', $id)
            ->select([
                'alunos_turmas.id as id',
                'alunos_turmas.matricula',
                'alunos.id as aluno_id',
                'cgm.nome',
                'turmas.nome as turma',
                'turmas.id as turma_id',
                'escola.nome as escola',
                'cursos.nome as curso',
                'curriculos.nome as curriculo',
                'calendarios.ano as calendario_ano',
                'series.nome as serie',
                'turnos.nome as turno',
                \DB::raw('DATE_FORMAT(alunos_turmas.data_matricula,"%d/%m/%Y") as data_matricula'),
                \DB::raw('DATE_FORMAT(alunos_turmas.data_saida,"%d/%m/%Y") as data_saida'),
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            //$html = '<a style="margin-right: 5%;" title="Editar" id="editarTelefone" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            //$html = '<a title="Remover" id="deleteAlunoTurma" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

            $html = " ";

            # Retorno
            return $html;
        })->addColumn('turmaAnterior', function ($row) {

            # pega a quantidade de alunos matrículados nessa turma
            $turmaAnterior = \DB::table('alunos_turmas')
                ->join('turmas', 'turmas.id', '=', 'alunos_turmas.turmas_id')
                ->groupBy('turmas.id')
                ->having('turmas.id', '!=', $row->turma_id)
                ->limit(1,1)
                ->where('alunos_turmas.alunos_id', '=', $row->aluno_id)
                ->select([
                    \DB::raw('(max(alunos_turmas.id) - 1) as maximo'),
                    'turmas.nome',
                ])->first();

            //dd($turmaAnterior);

            if($turmaAnterior) {
                return $turmaAnterior->nome;
            } else {
                return "";
            }

        })->make(true);
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $data = $request->all();

            # Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            # Executando a ação
            $retorno = $this->service->store($data);

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => $retorno['retorno'], 'resposta' => $retorno['resposta']]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            # Recuperando os dados da requisição
            $data = $request->all();

            # Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            # Executando a ação
            $this->service->update($data, $id);

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            # Executando a ação
            $this->service->destroy($id);

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTurma(Request $request)
    {

        $tipos = \DB::table('turmas')
            ->join('tipo_turmas', 'tipo_turmas.id', '=', 'turmas.tipo_turma_id')
            ->where('tipo_turmas.id', '=', '1')
            ->select('turmas.id', 'turmas.nome')
            ->get();

        return response()->json($tipos);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDadosTurma(Request $request)
    {
        $dados      = $request->request->all();
        
        try {

            # recuper os dados da turma
            $turma = \DB::table('turmas')
                ->join('escola', 'escola.id', '=', 'turmas.escola_id')
                ->join('cursos', 'cursos.id', '=', 'turmas.curso_id')
                ->join('curriculos', 'curriculos.id', '=', 'turmas.curriculo_id')
                ->join('calendarios', 'calendarios.id', '=', 'turmas.calendario_id')
                ->join('series', 'series.id', '=', 'turmas.serie_id')
                ->join('turnos', 'turnos.id', '=', 'turmas.turno_id')
                ->where('turmas.id', '=', $dados['turma'])
                ->select([
                    'turmas.vagas',
                    'escola.nome as escola',
                    'cursos.nome as curso',
                    'curriculos.nome as curriculo',
                    'calendarios.nome as calendario_nome',
                    'calendarios.ano as calendario_ano',
                    'series.nome as serie',
                    'turnos.nome as turno',
                ])
                ->first();

            # pega a quantidade de alunos matrículados nessa turma
            $alunoTurma = \DB::table('alunos_turmas')
                ->join('turmas', 'turmas.id', '=', 'alunos_turmas.turmas_id')
                ->groupBy('turmas.id')
                ->where('turmas.id', '=', $dados['turma'])
                ->select([
                    \DB::raw('count(alunos_turmas.id) as qtd'),
                ])->first();

            # pega os aluno que não estão matrículados nessa turma
            $alunoNotTurma = \DB::table('alunos')
                ->join('cgm', 'cgm.id', '=', 'alunos.cgm_id')
                ->whereNotIn('alunos.id', function ($where) use ($dados) {
                    $where->from('alunos')
                        ->select('alunos.id')
                        ->join('alunos_turmas', 'alunos_turmas.alunos_id', '=', 'alunos.id')
                        ->join('turmas', 'turmas.id', '=', 'alunos_turmas.turmas_id');
                        //->where('turmas.id', $dados['turma']);
                })
                ->select([
                    'alunos.id',
                    'cgm.nome'
                ])->get();

            # calculas a quantidade de vagas restantes
            if ($alunoTurma) {
                $qtdAlunos = $alunoTurma->qtd;
                $vagasRestantes = $turma->vagas - $qtdAlunos;
            } else {
                $vagasRestantes = "";
                $qtdAlunos      = "";
            }

            return response()->json(['dados' => $turma, 'qtdAlunos' => $qtdAlunos,
                'vRestantes' => $vagasRestantes, 'alunoNotTurma' => $alunoNotTurma]);

        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }

    }

}
