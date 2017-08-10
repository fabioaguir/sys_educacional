<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\HistoricoRepository;
use SerEducacional\Validators\HistoricoValidator;
use SerEducacional\Services\HistoricoService;
use Yajra\Datatables\Datatables;


class AlunoTurmasController extends Controller
{
    /**
     * @var HistoricoRepository
     */
    protected $repository;

    /**
     * @var HistoricoService
     */
    private $service;

    /**
     * @var HistoricoValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
    ];

    /**
     * @param HistoricoRepository $repository
     * @param HistoricoService $service
     * @param HistoricoValidator $validator
     */
    public function __construct(HistoricoRepository $repository,
                                HistoricoService $service,
                                HistoricoValidator $validator)
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
        $rows = \DB::table('edu_historico')
            ->join('edu_alunos', 'edu_alunos.id', '=', 'edu_historico.aluno_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_historico.turma_id')
            ->join('edu_escola', 'edu_escola.id', '=', 'edu_turmas.escola_id')
            ->join('edu_cursos', 'edu_cursos.id', '=', 'edu_turmas.curso_id')
            ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_turmas.curriculo_id')
            ->join('edu_calendarios', 'edu_calendarios.id', '=', 'edu_turmas.calendario_id')
            ->join('edu_series', 'edu_series.id', '=', 'edu_turmas.serie_id')
            ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_turmas.turno_id')
            ->join('edu_situacao_matricula', 'edu_situacao_matricula.id', '=', 'edu_historico.situacao_matricula_id')
            ->where('edu_historico.aluno_id', '=', $id)
            ->select([
                'edu_historico.id as id',
                'edu_historico.matricula',
                'edu_turmas.nome as turma',
                'edu_escola.nome as escola',
                'edu_cursos.nome as curso',
                'edu_curriculos.nome as curriculo',
                'edu_calendarios.ano as calendario_ano',
                'edu_series.nome as serie',
                'edu_turnos.nome as turno',
                \DB::raw('DATE_FORMAT(edu_historico.data_matricula,"%d/%m/%Y") as data_matricula'),
                'edu_situacao_matricula.nome as situacao'
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

            #Executando a ação
            $retorno = $this->service->storeUnico($data);

            if(!$retorno['retorno']) {
                return \Illuminate\Support\Facades\Response::json(['success' => false, 'mensagem' => $retorno['resposta']]);
            }

            # Retorno
            return \Illuminate\Support\Facades\Response::json(['success' => true]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function storeMudarTurma(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $data = $request->all();

            # Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            #Executando a ação
            $retorno = $this->service->storeMudarTurma($data);

            if(!$retorno['retorno']) {
                return \Illuminate\Support\Facades\Response::json(['success' => false, 'mensagem' => $retorno['resposta']]);
            }

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

        $turmas = \DB::table('edu_turmas')
            ->join('edu_tipo_turmas', 'edu_tipo_turmas.id', '=', 'edu_turmas.tipo_turma_id')
            ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_turmas.turno_id')
            ->where('edu_tipo_turmas.id', '=', '1')
            ->select([
                    'edu_turmas.id',
                    \DB::raw('CONCAT(edu_turmas.nome, " - " , edu_turnos.nome) as nome'),
                ])
            ->get();

        return response()->json($turmas);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTurmaMudanca(Request $request)
    {

        $turmas = \DB::table('edu_turmas')
            ->join('edu_tipo_turmas', 'edu_tipo_turmas.id', '=', 'edu_turmas.tipo_turma_id')
            ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_turmas.turno_id')
            ->where('edu_tipo_turmas.id', '=', '1')
            ->where('edu_turmas.serie_id', $request->get('idSerie'))
            ->where('edu_turmas.escola_id', $request->get('idEscola'))
            ->where('edu_turmas.id', '<>', $request->get('idTurma'))
            ->select([
                'edu_turmas.id',
                \DB::raw('CONCAT(edu_turmas.nome, " - " , edu_turnos.nome) as nome'),
            ])->get();

        return response()->json($turmas);

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
            $alunoTurma = \DB::table('edu_historico')
                ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_historico.turma_id')
                ->groupBy('edu_turmas.id')
                ->where('edu_turmas.id', '=', $dados['turma'])
                ->select([
                    \DB::raw('count(edu_historico.id) as qtd'),
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
