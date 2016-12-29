<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\FormacaoCreateRequest;
use SerEducacional\Http\Requests\FormacaoUpdateRequest;
use SerEducacional\Repositories\FormacaoRepository;
use SerEducacional\Validators\FormacaoValidator;
use SerEducacional\Services\FormacaoService;
use Yajra\Datatables\Datatables;


class FormacaosController extends Controller
{

    /**
     * @var FormacaoRepository
     */
    protected $repository;

    /**
     * @var FormacaoService
     */
    private $service;

    /**
     * @var FormacaoValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
    ];

    /**
     * FormacaosController constructor.
     * @param FormacaoRepository $repository
     * @param FormacaoService $service
     * @param FormacaoValidator $validator
     */
    public function __construct(FormacaoRepository $repository,
                                FormacaoService $service,
                                FormacaoValidator $validator)
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
        $rows = \DB::table('formacoes')
            ->join('cursos_formacao', 'cursos_formacao.id', '=', 'formacoes.cursos_formacao_id')
            ->join('situacao_formacao', 'situacao_formacao.id', '=', 'formacoes.situacao_formacao_id')
            ->join('licenciatura', 'licenciatura.id', '=', 'formacoes.licenciatura_id')
            ->join('instituicoes_formacao', 'instituicoes_formacao.id', '=', 'formacoes.instituicoes_formacao_id')
            ->join('servidor', 'servidor.id', '=', 'formacoes.servidor_id')
            ->where('formacoes.servidor_id', '=', $id)
            ->select([
                'formacoes.id as id',
                'formacoes.ano_conclusao',
                'cursos_formacao.id as curso_id',
                'cursos_formacao.nome as curso',
                'situacao_formacao.id as situacao_id',
                'situacao_formacao.nome as situacao',
                'licenciatura.id as licenciatura_id',
                'licenciatura.nome as licenciatura',
                'instituicoes_formacao.id as instituicao_id',
                'instituicoes_formacao.nome as instituicao',

            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html = '<a style="margin-right: 5%;" title="Editar" id="editarFormacao" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a title="Remover" id="deleteFormacao" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
    public function getCursos(Request $request)
    {

        $query = \DB::table('cursos_formacao')
            ->select('cursos_formacao.id', 'cursos_formacao.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInstituicoes(Request $request)
    {

        $query = \DB::table('instituicoes_formacao')
            ->select('instituicoes_formacao.id', 'instituicoes_formacao.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSituacoes(Request $request)
    {

        $query = \DB::table('situacao_formacao')
            ->select('situacao_formacao.id', 'situacao_formacao.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLicenciaturas(Request $request)
    {

        $query = \DB::table('licenciatura')
            ->select('licenciatura.id', 'licenciatura.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPos(Request $request)
    {

        $query = \DB::table('pos_graduacao')
            ->select('pos_graduacao.id', 'pos_graduacao.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOutrosCursos(Request $request)
    {

        $query = \DB::table('outros_cursos')
            ->select('outros_cursos.id', 'outros_cursos.nome')
            ->get();

        return response()->json($query);

    }

}
