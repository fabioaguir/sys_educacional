<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\RelacaoTrabalhoCreateRequest;
use SerEducacional\Http\Requests\RelacaoTrabalhoUpdateRequest;
use SerEducacional\Repositories\RelacaoTrabalhoRepository;
use SerEducacional\Validators\RelacaoTrabalhoValidator;
use SerEducacional\Services\RelacaoTrabalhoService;
use Yajra\Datatables\Datatables;
use SerEducacional\Uteis\SerbinarioDateFormat;


class RelacaoTrabalhosController extends Controller
{

    /**
     * @var RelacaoTrabalhoRepository
     */
    protected $repository;

    /**
     * @var RelacaoTrabalhoService
     */
    private $service;

    /**
     * @var RelacaoTrabalhoValidator
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
     * RelacaoTrabalhosController constructor.
     * @param RelacaoTrabalhoRepository $repository
     * @param RelacaoTrabalhoService $service
     * @param RelacaoTrabalhoValidator $validator
     */
    public function __construct(RelacaoTrabalhoRepository $repository,
                                RelacaoTrabalhoService $service,
                                RelacaoTrabalhoValidator $validator)
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
        $rows = \DB::table('edu_relacao_trabalho')
            ->join('edu_regime_trabalho', 'edu_regime_trabalho.id', '=', 'edu_relacao_trabalho.regime_trabalho_id')
            ->join('edu_area_trabalho', 'edu_area_trabalho.id', '=', 'edu_relacao_trabalho.area_trabalho_id')
            ->join('edu_disciplinas', 'edu_disciplinas.id', '=', 'edu_relacao_trabalho.disciplinas_id')
            ->join('edu_niveis_ensino', 'edu_niveis_ensino.id', '=', 'edu_relacao_trabalho.niveis_ensino_id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_relacao_trabalho.servidor_id')
            ->where('edu_relacao_trabalho.servidor_id', '=', $id)
            ->select([
                'edu_relacao_trabalho.id as id',
                'edu_regime_trabalho.id as regime_id',
                'edu_regime_trabalho.nome as regime',
                'edu_area_trabalho.id as area_id',
                'edu_area_trabalho.nome as area',
                'edu_disciplinas.id as disciplinas_id',
                'edu_disciplinas.nome as disciplina',
                'edu_niveis_ensino.id as niveis_ensino_id',
                'edu_niveis_ensino.nome as niveis_ensino',

            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html = '<a style="margin-right: 5%;" title="Editar" id="editarRelacao" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a title="Remover" id="deleteRelacao" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
    public function getRegimes(Request $request)
    {

        $query = \DB::table('edu_regime_trabalho')
            ->select('edu_regime_trabalho.id', 'edu_regime_trabalho.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAreas(Request $request)
    {

        $query = \DB::table('edu_area_trabalho')
            ->select('edu_area_trabalho.id', 'edu_area_trabalho.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEnsinos(Request $request)
    {

        $query = \DB::table('edu_niveis_ensino')
            ->select('edu_niveis_ensino.id', 'edu_niveis_ensino.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDisciplinas(Request $request)
    {

        $query = \DB::table('edu_disciplinas')
            ->select('edu_disciplinas.id', 'edu_disciplinas.nome')
            ->get();

        return response()->json($query);

    }
}
