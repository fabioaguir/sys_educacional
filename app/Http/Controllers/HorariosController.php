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
        $rows = \DB::table('horarios')
            ->join('horas', 'horas.id', '=', 'horarios.horas_id')
            ->join('turnos', 'turnos.id', '=', 'horas.turnos_id')
            ->join('dias_semana', 'dias_semana.id', '=', 'horarios.dia_semana_id')
            ->join('disciplinas', 'disciplinas.id', '=', 'horarios.disciplinas_id')
            ->join('servidor', 'servidor.id', '=', 'horarios.servidor_id')
            ->join('cgm', 'cgm.id', '=', 'servidor.id_cgm')
            ->join('turmas', 'turmas.id', '=', 'horarios.turmas_id')
            ->where('turmas.id', '=', $idTurma)
            ->select([
                'horarios.id as id',
                'dias_semana.nome as dia',
                'dias_semana.id as dia_id',
                'turnos.nome as turno',
                'turnos.id as turno_id',
                \DB::raw("CONCAT(DATE_FORMAT(horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(horas.hora_final,'%h:%i')) AS hora"),
                'horas.id as hora_id',
                'disciplinas.nome as disciplina',
                'disciplinas.id as disciplina_id',
                'cgm.nome as professor',
                'servidor.id as professor_id',
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

        $rows = \DB::table('disciplinas')
            ->join('curriculos_series_disciplinas', 'curriculos_series_disciplinas.disciplina_id', '=', 'disciplinas.id')
            ->join('curriculos_series', 'curriculos_series.id', '=', 'curriculos_series_disciplinas.curriculo_serie_id')
            ->join('curriculos', 'curriculos.id', '=', 'curriculos_series.curriculo_id')
            ->join('turmas', 'turmas.curriculo_id', '=', 'curriculos.id')
            ->where('turmas.id', $dados['idTurma'])
            ->where('curriculos_series.serie_id', $dados['idSerie'])
            ->select([
                'disciplinas.id as id',
                'disciplinas.nome as nome',
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

        $rows = \DB::table('servidor')
            ->join('alocacoes', 'alocacoes.servidor_id', '=', 'servidor.id')
            ->join('escola', 'escola.id', '=', 'alocacoes.escola_id')
            ->join('funcoes', 'funcoes.id', '=', 'servidor.funcoes_id')
            ->join('cgm', 'cgm.id', '=', 'servidor.id_cgm')
            ->where('escola.id', $dados['idEscola'])
            ->where('funcoes.funcao_professor', '1')
            ->select([
                'servidor.id as id',
                'cgm.nome as nome',
            ])->get();

        return response()->json($rows);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDias(Request $request)
    {
        $dados = $request->request->all();


        $query = \DB::table('dias_semana')
            ->join('disponibilidades', 'disponibilidades.dia_semana_id', '=', 'dias_semana.id')
            ->join('servidor', 'disponibilidades.servidor_id', '=', 'servidor.id')
            ->join('escola', 'disponibilidades.escola_id', '=', 'escola.id')
            ->where('escola.id', $dados['idEscola'])
            ->where('servidor.id', $dados['idProfessor'])
            ->select('dias_semana.id', 'dias_semana.nome')
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

        $query = \DB::table('horas')
            ->join('disponibilidades', 'disponibilidades.hora_id', '=', 'horas.id')
            ->join('servidor', 'disponibilidades.servidor_id', '=', 'servidor.id')
            ->join('escola', 'disponibilidades.escola_id', '=', 'escola.id')
            ->join('turnos', 'turnos.id', '=', 'horas.turnos_id')
            ->join('dias_semana', 'dias_semana.id', '=', 'disponibilidades.dia_semana_id')
            ->where('escola.id', $dados['idEscola'])
            ->where('servidor.id', $dados['idProfessor'])
            ->where('dias_semana.id', '=', $dados['idDia'])
            ->where('turnos.id', '=', $dados['idTurno'])
            ->whereNotIn('horas.id', function ($where) use ($dados) {
                $where->from('horas')
                    ->select('horas.id')
                    ->join('horarios', 'horarios.horas_id', '=', 'horas.id')
                    ->join('servidor', 'horarios.servidor_id', '=', 'servidor.id')
                    ->join('dias_semana', 'dias_semana.id', '=', 'horarios.dia_semana_id')
                    ->where('servidor.id', $dados['idProfessor'])
                    ->where('dias_semana.id', '=', $dados['idDia']);
            })
            ->select(
                'horas.id as id',
                \DB::raw("CONCAT(DATE_FORMAT(horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(horas.hora_final,'%h:%i')) AS nome"))
            ->get();

        return response()->json($query);

    }

}
