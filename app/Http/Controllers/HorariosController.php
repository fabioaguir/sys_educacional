<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\HorarioCreateRequest;
use SerEducacional\Http\Requests\HorarioUpdateRequest;
use SerEducacional\Repositories\HorarioRepository;
use SerEducacional\Validators\HorarioValidator;
use SerEducacional\Services\HorarioService;
use Yajra\Datatables\Datatables;
use SerEducacional\Uteis\SerbinarioDateFormat;


class HorariosController extends Controller
{
    /**
     * @var HorarioRepository
     */
    protected $repository;

    /**
     * @var HorarioService
     */
    private $service;

    /**
     * @var HorarioValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Status',
        'Duracao'
    ];

    /**
     * EventosController constructor.
     * @param HorarioRepository $repository
     * @param HorarioService $service
     * @param HorarioValidator $validator
     */
    public function __construct(HorarioRepository $repository,
                                HorarioService $service,
                                HorarioValidator $validator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function grid($idTurma)
    {
        #Criando a consulta
        $rows = \DB::table('edu_horarios')
            ->join('edu_horas', 'edu_horas.id', '=', 'edu_horarios.horas_id')
            ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_horas.turnos_id')
            ->join('edu_dias_semana', 'edu_dias_semana.id', '=', 'edu_horarios.dia_semana_id')
            ->join('edu_disciplinas', 'edu_disciplinas.id', '=', 'edu_horarios.disciplinas_id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_horarios.servidor_id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_servidor.id_cgm')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_horarios.turmas_id')
            ->where('edu_turmas.id', '=', $idTurma)
            ->select([
                'edu_horarios.id as id',
                'edu_dias_semana.nome as dia',
                'edu_dias_semana.id as dia_id',
                'edu_turnos.nome as turno',
                'edu_turnos.id as turno_id',
                \DB::raw("CONCAT(DATE_FORMAT(edu_horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(edu_horas.hora_final,'%h:%i')) AS hora"),
                'edu_horas.id as hora_id',
                'edu_disciplinas.nome as disciplina',
                'edu_disciplinas.id as disciplina_id',
                'gen_cgm.nome as professor',
                'edu_servidor.id as professor_id',
            ]);
        
        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            //$html = '<a style="margin-right: 5%;" title="Editar" id="editarTelefone" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html = '<a title="Remover" id="deleteHorario" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
            #Recuperando os dados da requisição
            $data = $request->all();

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            #Executando a ação
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
            #Recuperando os dados da requisição
            $data = $request->all();

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            #Executando a ação
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
            #Executando a ação
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
    public function getDisciplinas(Request $request)
    {

        $dados = $request->all();

        $rows = \DB::table('edu_disciplinas')
            ->join('edu_curriculos_series_disciplinas', 'edu_curriculos_series_disciplinas.disciplina_id', '=', 'edu_disciplinas.id')
            ->join('edu_curriculos_series', 'edu_curriculos_series.id', '=', 'edu_curriculos_series_disciplinas.curriculo_serie_id')
            ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_curriculos_series.curriculo_id')
            ->join('edu_turmas', 'edu_turmas.curriculo_id', '=', 'edu_curriculos.id')
            ->where('edu_turmas.id', $dados['idTurma'])
            ->where('edu_curriculos_series.serie_id', $dados['idSerie'])
            ->select([
                'edu_disciplinas.id as id',
                'edu_disciplinas.nome as nome',
            ])->get();

        return response()->json($rows);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfessores(Request $request)
    {

        $dados = $request->all();

        $rows = \DB::table('edu_servidor')
            ->join('edu_alocacoes', 'edu_alocacoes.servidor_id', '=', 'edu_servidor.id')
            ->join('edu_escola', 'edu_escola.id', '=', 'edu_alocacoes.escola_id')
            ->join('edu_funcoes', 'edu_funcoes.id', '=', 'edu_servidor.funcoes_id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_servidor.id_cgm')
            ->whereNotIn('edu_servidor.id', function ($where) use ($dados) {
                $where->from('edu_servidor')
                    ->select('edu_servidor.id')
                    ->join('edu_horarios', 'edu_servidor.id', '=', 'edu_horarios.servidor_id')
                    ->join('edu_horas', 'edu_horarios.horas_id', '=', 'edu_horas.id')
                    ->join('edu_dias_semana', 'edu_dias_semana.id', '=', 'edu_horarios.dia_semana_id')
                    ->where('edu_horas.id', $dados['idHora'])
                    ->where('edu_dias_semana.id', '=', $dados['idDia']);
            })
            ->where('edu_escola.id', $dados['idEscola'])
            ->where('edu_funcoes.funcao_professor', '1')
            ->select([
                'edu_servidor.id as id',
                'gen_cgm.nome as nome',
            ])->get();

        return response()->json($rows);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDias(Request $request)
    {

        $query = \DB::table('edu_dias_semana')
            ->select('edu_dias_semana.id', 'edu_dias_semana.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHoras(Request $request)
    {

        $dados = $request->request->all();

        $query = \DB::table('edu_horas')
            ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_horas.turnos_id')
            ->where('edu_turnos.id', '=', $dados['idTurno'])
            ->whereNotIn('edu_horas.id', function ($where) use ($dados) {
                $where->from('edu_horas')
                    ->select('edu_horas.id')
                    ->join('edu_horarios', 'edu_horarios.horas_id', '=', 'edu_horas.id')
                    ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_horarios.turmas_id')
                    ->join('edu_dias_semana', 'edu_dias_semana.id', '=', 'edu_horarios.dia_semana_id')
                    ->where('edu_turmas.id', $dados['idTurma'])
                    ->where('edu_dias_semana.id', '=', $dados['idDia']);
            })
            ->select(
                'edu_horas.id as id',
                \DB::raw("CONCAT(DATE_FORMAT(edu_horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(edu_horas.hora_final,'%h:%i')) AS nome"))
            ->get();

        return response()->json($query);

    }

}
