<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\AlocacaoCreateRequest;
use SerEducacional\Http\Requests\AlocacaoUpdateRequest;
use SerEducacional\Repositories\AlocacaoRepository;
use SerEducacional\Validators\AlocacaoValidator;
use SerEducacional\Services\AlocacaoService;
use Yajra\Datatables\Datatables;


class AlocacaosController extends Controller
{
    /**
     * @var AlocacaoRepository
     */
    protected $repository;

    /**
     * @var AlocacaoService
     */
    private $service;

    /**
     * @var AlocacaoValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
    ];

    /**
     * AlocacaosController constructor.
     * @param AlocacaoRepository $repository
     * @param AlocacaoService $service
     * @param AlocacaoValidator $validator
     */
    public function __construct(AlocacaoRepository $repository,
                                AlocacaoService $service,
                                AlocacaoValidator $validator)
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
        $rows = \DB::table('alocacoes')
            ->join('servidor', 'servidor.id', '=', 'alocacoes.servidor_id')
            ->join('escola', 'escola.id', '=', 'alocacoes.escola_id')
            ->where('alocacoes.servidor_id', '=', $id)
            ->select([
                'alocacoes.id as id',
                'escola.nome as escola',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            //$html = '<a style="margin-right: 5%;" title="Editar" id="editarTelefone" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html = '<a title="Remover" id="deleteAlocacao" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
    public function getEscolas(Request $request)
    {

        $tipos = \DB::table('escola')
            ->select('escola.id', 'escola.nome')
            ->get();

        return response()->json($tipos);

    }

}
