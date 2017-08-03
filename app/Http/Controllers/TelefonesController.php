<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\TelefoneRepository;
use SerEducacional\Validators\TelefoneValidator;
use SerEducacional\Services\TelefoneService;
use Yajra\Datatables\Datatables;
use SerEducacional\Uteis\SerbinarioDateFormat;


class TelefonesController extends Controller
{
    /**
     * @var TelefoneRepository
     */
    protected $repository;

    /**
     * @var TelefoneService
     */
    private $service;

    /**
     * @var TelefoneValidator
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
     * @param TelefoneRepository $repository
     * @param TelefoneService $service
     * @param TelefoneValidator $validator
     */
    public function __construct(TelefoneRepository $repository,
                                TelefoneService $service,
                                TelefoneValidator $validator)
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
        $rows = \DB::table('edu_telefones')
            ->join('edu_tipo_telefones', 'edu_tipo_telefones.id', '=', 'edu_telefones.tipo_telefones_id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_telefones.cgm_id')
            ->where('edu_telefones.cgm_id', '=', $id)
            ->select([
                'edu_telefones.id as id',
                'edu_telefones.nome as nome',
                'edu_telefones.ramal',
                'edu_telefones.observacao',
                'edu_tipo_telefones.nome as tipo',
                'edu_tipo_telefones.id as tipo_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html = '<a style="margin-right: 5%;" title="Editar" id="editarTelefone" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a title="Remover" id="deleteTelefone" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
    public function getTipoTelefone(Request $request)
    {

        $tipos = \DB::table('edu_tipo_telefones')
            ->select('edu_tipo_telefones.id', 'edu_tipo_telefones.nome')
            ->get();

        return response()->json($tipos);

    }
    
}
