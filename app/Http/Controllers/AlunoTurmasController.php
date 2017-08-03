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
use SerEducacional\Services\AlunoTurmaService;
use Yajra\Datatables\Datatables;


class AlunoTurmasController extends Controller
{
    /**
     * @var AlunoTurmaRepository
     */
    protected $repository;

    /**
     * @var AlunoTurmaService
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
     * @param AlunoTurmaService $service
     * @param AlunoTurmaValidator $validator
     */
    public function __construct(AlunoTurmaRepository $repository,
                                AlunoTurmaService $service,
                                AlunoTurmaValidator $validator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function grid($id)
    {
        #Criando a consulta
        $rows = \DB::table('edu_alunos_turmas')
            ->join('edu_alunos', 'edu_alunos.id', '=', 'edu_alunos_turmas.alunos_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_alunos_turmas.turmas_id')
            ->join('edu_escola', 'edu_escola.id', '=', 'edu_turmas.escola_id')
            ->join('edu_cursos', 'edu_cursos.id', '=', 'edu_turmas.curso_id')
            ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_turmas.curriculo_id')
            ->join('edu_calendarios', 'edu_calendarios.id', '=', 'edu_turmas.calendario_id')
            ->join('edu_series', 'edu_series.id', '=', 'edu_turmas.serie_id')
            ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_turmas.turno_id')
            ->where('edu_alunos_turmas.alunos_id', '=', $id)
            ->select([
                'edu_alunos_turmas.id as id',
                'edu_alunos_turmas.matricula',
                'edu_turmas.nome as turma',
                'edu_escola.nome as escola',
                'edu_cursos.nome as curso',
                'edu_curriculos.nome as curriculo',
                'edu_calendarios.ano as calendario_ano',
                'edu_series.nome as serie',
                'edu_turnos.nome as turno',
                \DB::raw('DATE_FORMAT(edu_alunos_turmas.data_matricula,"%d/%m/%Y") as data_matricula'),
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            //$html = '<a style="margin-right: 5%;" title="Editar" id="editarTelefone" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            //$html = '<a title="Remover" id="deleteAlunoTurma" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

            $html = " ";

            # Retorno
            return $html;
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
            $this->service->store($data);

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
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

        $tipos = \DB::table('edu_turmas')
            ->join('edu_tipo_turmas', 'edu_tipo_turmas.id', '=', 'edu_turmas.tipo_turma_id')
            ->where('edu_tipo_turmas.id', '=', '1')
            ->select('edu_turmas.id', 'edu_turmas.nome')
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
            $turma = \DB::table('edu_turmas')
                ->join('edu_escola', 'edu_escola.id', '=', 'edu_turmas.escola_id')
                ->join('edu_cursos', 'edu_cursos.id', '=', 'edu_turmas.curso_id')
                ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_turmas.curriculo_id')
                ->join('edu_calendarios', 'edu_calendarios.id', '=', 'edu_turmas.calendario_id')
                ->join('edu_series', 'edu_series.id', '=', 'edu_turmas.serie_id')
                ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_turmas.turno_id')
                ->where('edu_turmas.id', '=', $dados['turma'])
                ->select([
                    'edu_turmas.vagas',
                    'edu_escola.nome as escola',
                    'edu_cursos.nome as curso',
                    'edu_curriculos.nome as curriculo',
                    'edu_calendarios.nome as calendario_nome',
                    'edu_calendarios.ano as calendario_ano',
                    'edu_series.nome as serie',
                    'edu_turnos.nome as turno',
                ])
                ->first();

            # pega a quantidade de alunos matrículados nessa turma
            $alunoTurma = \DB::table('edu_alunos_turmas')
                ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_alunos_turmas.turmas_id')
                ->groupBy('edu_turmas.id')
                ->where('edu_turmas.id', '=', $dados['turma'])
                ->select([
                    \DB::raw('count(edu_alunos_turmas.id) as qtd'),
                ])->first();

            # calculas a quantidade de vagas restantes
            if ($alunoTurma) {
                $qtdAlunos = $alunoTurma->qtd;
                $vagasRestantes = $turma->vagas - $qtdAlunos;
            } else {
                $vagasRestantes = "";
                $qtdAlunos      = "";
            }

            return response()->json(['dados' => $turma, 'qtdAlunos' => $qtdAlunos, 'vRestantes' => $vagasRestantes]);

        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }

    }

}
