<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\ConcelhoPedagogicoRepository;
use SerEducacional\Services\ConcelhoPedagogicoService;
use SerEducacional\Validators\ConcelhoPedagogicoValidator;
use Yajra\Datatables\Datatables;


class ConcelhoPedagogicoController extends Controller
{

    /**
     * @var ConcelhoPedagogicoRepository
     */
    protected $repository;

    /**
     * @var ConcelhoPedagogicoValidator
     */
    protected $validator;

    /**
     * @var ConcelhoPedagogicoService
     */
    private $service;


    /**
     * @var array
     */
    private $loadFields = [];

    /**
     * @param ConcelhoPedagogicoRepository $repository
     * @param ConcelhoPedagogicoValidator $validator
     * @param ConcelhoPedagogicoService $service
     */
    public function __construct(ConcelhoPedagogicoRepository $repository,
                                ConcelhoPedagogicoValidator $validator,
                                ConcelhoPedagogicoService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
    }

    /**
     * @return mixed
     */
    public function grid($id)
    {
        #Criando a consulta
        $rows = \DB::table('edu_concelho_pedagogico')
            ->join('edu_periodos', 'edu_periodos.id', '=', 'edu_concelho_pedagogico.periodo_id')
            ->where('edu_concelho_pedagogico.id', $id)
            ->select([
                'edu_concelho_pedagogico.id',
                'edu_concelho_pedagogico.dificuldades',
                'edu_concelho_pedagogico.orientacoes',
                'edu_periodos.nome as periodo',
                'edu_periodos.id as periodo_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # Variáveis de uso
            $html  = '';

            $html .= '<a style="margin-right: 5%;" title="Editar" id="editarConcelho" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
            $html .= '<a title="Remover" id="deleteConcelho" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
    public function getPeriodos(Request $request)
    {

        # Trazendo os alunos os períodos
        $query = \DB::table('edu_periodos_avaliacao')
            ->join('edu_periodos', 'edu_periodos.id', '=', 'edu_periodos_avaliacao.periodos_id')
            ->join('edu_calendarios', 'edu_calendarios.id', '=', 'edu_periodos_avaliacao.calendarios_id')
            ->join('edu_turmas', 'edu_calendarios.id', '=', 'edu_turmas.calendario_id')
            ->where('edu_turmas.id', $request->get('idTurma'))
            ->orderBy('edu_periodos.nome', 'ASC')
            ->select([
                'edu_periodos.nome',
                'edu_periodos.id'
            ])->get();

        return response()->json($query);

    }
}
