<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\AtividadeCreateRequest;
use SerEducacional\Http\Requests\AtividadeUpdateRequest;
use SerEducacional\Repositories\AtividadeRepository;
use SerEducacional\Validators\AtividadeValidator;
use SerEducacional\Services\AtividadeService;
use Yajra\Datatables\Datatables;


class AtividadesController extends Controller
{
    /**
     * @var AtividadeRepository
     */
    protected $repository;

    /**
     * @var AtividadeService
     */
    private $service;

    /**
     * @var AtividadeValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
    ];

    /**
     * AtividadesController constructor.
     * @param AtividadeRepository $repository
     * @param AtividadeService $service
     * @param AtividadeValidator $validator
     */
    public function __construct(AtividadeRepository $repository,
                                AtividadeService $service,
                                AtividadeValidator $validator)
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
        $rows = \DB::table('atividades')
            ->join('funcoes', 'funcoes.id', '=', 'atividades.funcoes_id')
            ->join('servidor', 'servidor.id', '=', 'atividades.servidor_id')
            ->where('atividades.servidor_id', '=', $id)
            ->select([
                'atividades.id as id',
                'atividades.horas_manha',
                'atividades.horas_tarde',
                'atividades.horas_noite',
                'funcoes.nome as funcao',
                'funcoes.id as funcao_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html = '<a style="margin-right: 5%;" title="Editar" id="editarAtividade" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a title="Remover" id="deleteAtividade" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
    public function getFuncoes(Request $request)
    {

        $query = \DB::table('funcoes')
            ->select('funcoes.id', 'funcoes.nome')
            ->get();

        return response()->json($query);

    }

}
