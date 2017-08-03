<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\FormacaoCreateRequest;
use SerEducacional\Http\Requests\FormacaoUpdateRequest;
use SerEducacional\Repositories\FormacaoRepository;
use SerEducacional\Repositories\ServidorRepository;
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
     * @var FormacaoRepository
     */
    protected $servidorRepository;

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
                                FormacaoValidator $validator,
                                ServidorRepository $servidorRepository)
    {
        $this->repository = $repository;
        $this->servidorRepository = $servidorRepository;
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function grid($id)
    {
        #Criando a consulta
        $rows = \DB::table('edu_formacoes')
            ->join('edu_cursos_formacao', 'edu_cursos_formacao.id', '=', 'edu_formacoes.cursos_formacao_id')
            ->join('edu_situacao_formacao', 'edu_situacao_formacao.id', '=', 'edu_formacoes.situacao_formacao_id')
            ->join('edu_licenciatura', 'edu_licenciatura.id', '=', 'edu_formacoes.licenciatura_id')
            ->join('edu_instituicoes_formacao', 'edu_instituicoes_formacao.id', '=', 'edu_formacoes.instituicoes_formacao_id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_formacoes.servidor_id')
            ->where('edu_formacoes.servidor_id', '=', $id)
            ->select([
                'edu_formacoes.id as id',
                'edu_formacoes.ano_conclusao',
                'edu_cursos_formacao.id as curso_id',
                'edu_cursos_formacao.nome as curso',
                'edu_situacao_formacao.id as situacao_id',
                'edu_situacao_formacao.nome as situacao',
                'edu_licenciatura.id as licenciatura_id',
                'edu_licenciatura.nome as licenciatura',
                'edu_instituicoes_formacao.id as instituicao_id',
                'edu_instituicoes_formacao.nome as instituicao',

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
     * @return \Exception
     */
    public function edtOutrosCursos(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados = $request->all();

            #Validando os parametros de entrada
            if(!isset($dados['idPos']) && !isset($dados['idOutros'])
                && !isset($dados['servidor_id'])) {
                return new \Exception("Parâmetros inválidos");
            }

            #Recuperando a entidade
            $servidor = $this->servidorRepository->find($dados['servidor_id']);

            $servidor->posgraduacao()->detach();
            $servidor->posgraduacao()->attach($dados['idPos']);

            $servidor->outroscursos()->detach();
            $servidor->outroscursos()->attach($dados['idOutros']);
            
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

        $query = \DB::table('edu_cursos_formacao')
            ->select('edu_cursos_formacao.id', 'edu_cursos_formacao.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInstituicoes(Request $request)
    {

        $query = \DB::table('edu_instituicoes_formacao')
            ->select('edu_instituicoes_formacao.id', 'edu_instituicoes_formacao.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSituacoes(Request $request)
    {

        $query = \DB::table('edu_situacao_formacao')
            ->select('edu_situacao_formacao.id', 'edu_situacao_formacao.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLicenciaturas(Request $request)
    {

        $query = \DB::table('edu_licenciatura')
            ->select('edu_licenciatura.id', 'edu_licenciatura.nome')
            ->get();

        return response()->json($query);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPos(Request $request)
    {

        $dados = $request->request->all();

        $pos = \DB::table('edu_servidor_pos_graduacao')
            ->join('edu_pos_graduacao', 'edu_pos_graduacao.id', '=', 'edu_servidor_pos_graduacao.pos_graduacao_id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_servidor_pos_graduacao.servidor_id')
            ->where('edu_servidor_pos_graduacao.servidor_id', '=', $dados['servidor_id'])
            ->select(['edu_pos_graduacao.id'])
            ->get();
        
        $query = \DB::table('edu_pos_graduacao')
            ->select('edu_pos_graduacao.id', 'edu_pos_graduacao.nome')
            ->get();

        return response()->json(['pos' => $pos, 'query' => $query]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOutrosCursos(Request $request)
    {

        $dados = $request->request->all();
        
        $outrosCursos = \DB::table('edu_outros_cursos_servidor')
            ->join('edu_outros_cursos', 'edu_outros_cursos.id', '=', 'edu_outros_cursos_servidor.outros_cursos_id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_outros_cursos_servidor.servidor_id')
            ->where('edu_outros_cursos_servidor.servidor_id', '=', $dados['servidor_id'])
            ->select(['edu_outros_cursos.id'])
            ->get();
        
        $query = \DB::table('edu_outros_cursos')
            ->select('edu_outros_cursos.id', 'edu_outros_cursos.nome')
            ->get();

        return response()->json(['outros' => $outrosCursos, 'query' => $query]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPosOutrosCursos(Request $request)
    {
        
        $dados = $request->request->all();

        $pos = \DB::table('edu_servidor_pos_graduacao')
            ->join('edu_pos_graduacao', 'edu_pos_graduacao.id', '=', 'edu_servidor_pos_graduacao.pos_graduacao_id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_servidor_pos_graduacao.servidor_id')
            ->where('edu_servidor_pos_graduacao.servidor_id', '=', $dados['servidor_id'])
            ->select(['edu_pos_graduacao.id'])
            ->get();

        $outrosCursos = \DB::table('edu_outros_cursos_servidor')
            ->join('edu_outros_cursos', 'edu_outros_cursos.id', '=', 'edu_outros_cursos_servidor.outros_cursos_id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_outros_cursos_servidor.servidor_id')
            ->where('edu_outros_cursos_servidor.servidor_id', '=', $dados['servidor_id'])
            ->select(['edu_outros_cursos.id'])
            ->get();

        return response()->json(['pos' => $pos, 'outros' => $outrosCursos]);

    }

}
