<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\DisponibilidadeCreateRequest;
use SerEducacional\Http\Requests\DisponibilidadeUpdateRequest;
use SerEducacional\Repositories\DisponibilidadeRepository;
use SerEducacional\Validators\DisponibilidadeValidator;
use SerEducacional\Services\DisponibilidadeService;
use Yajra\Datatables\Datatables;
use SerEducacional\Uteis\SerbinarioDateFormat;


class DisponibilidadesController extends Controller
{
    /**
     * @var DisponibilidadeRepository
     */
    protected $repository;

    /**
     * @var DisponibilidadeService
     */
    private $service;

    /**
     * @var DisponibilidadeValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [];

    /**
     * EventosController constructor.
     * @param DisponibilidadeRepository $repository
     * @param DisponibilidadeService $service
     * @param DisponibilidadeValidator $validator
     */
    public function __construct(DisponibilidadeRepository $repository,
                                DisponibilidadeService $service,
                                DisponibilidadeValidator $validator)
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
        $rows = \DB::table('disponibilidades')
            ->join('servidor', 'servidor.id', '=', 'disponibilidades.servidor_id')
            ->join('escola', 'escola.id', '=', 'disponibilidades.escola_id')
            ->join('dias_semana', 'dias_semana.id', '=', 'disponibilidades.dia_semana_id')
            ->join('horas', 'horas.id', '=', 'disponibilidades.hora_id')
            ->join('turnos', 'turnos.id', '=', 'horas.turnos_id')
            ->where('disponibilidades.servidor_id', '=', $id)
            ->select([
                'disponibilidades.id as id',
                'escola.nome as escola',
                'escola.id as escola_id',
                'dias_semana.nome as dia_semana',
                'dias_semana.id as dia_semana_id',
                \DB::raw("CONCAT(DATE_FORMAT(horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(horas.hora_final,'%h:%i')) AS horario"),
                'horas.id as hora_id',
                'turnos.nome as turno',
                'turnos.id as turno_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html = '<a style="margin-right: 5%;" title="Editar" id="editarDisponibilidade" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a title="Remover" id="deleteDisponibilidade" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
    public function getDias(Request $request)
    {

        $query = \DB::table('dias_semana')
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
            ->join('turnos', 'turnos.id', '=', 'horas.turnos_id')
            ->where('turnos.id', '=', $dados['idTurno'])
            ->select(
                'horas.id as id',
                \DB::raw("CONCAT(DATE_FORMAT(horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(horas.hora_final,'%h:%i')) AS nome"))
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTurnos(Request $request)
    {

        $query = \DB::table('turnos')
            ->select('turnos.id', 'turnos.nome')
            ->get();

        return response()->json($query);

    }

}
