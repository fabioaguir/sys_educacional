<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\AlunoTurmaCreateRequest;
use SerEducacional\Http\Requests\AlunoTurmaUpdateRequest;
use SerEducacional\Repositories\AlunoTurmaRepository;
use SerEducacional\Validators\AlunoTurmaValidator;
use SerEducacional\Services\AlunoTurmaService;
use Yajra\Datatables\Datatables;


class AlunoTurmasController extends Controller
{
    /**
     * @var AlunoTurmaRepository
     */
    protected $repository;

    /**
     * @var AlunoTurmaService
     */
    private $service;

    /**
     * @var AlunoTurmaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
    ];

    /**
     * AlunoTurmasController constructor.
     * @param AlunoTurmaRepository $repository
     * @param AlunoTurmaService $service
     * @param AlunoTurmaValidator $validator
     */
    public function __construct(AlunoTurmaRepository $repository,
                                AlunoTurmaService $service,
                                AlunoTurmaValidator $validator)
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
        $rows = \DB::table('alunos_turmas')
            ->join('alunos', 'alunos.id', '=', 'alunos_turmas.alunos_id')
            ->join('turmas', 'turmas.id', '=', 'alunos_turmas.turmas_id')
            ->where('alunos_turmas.alunos_id', '=', $id)
            ->select([
                'alunos_turmas.id as id',
                'turmas.nome as turma',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            //$html = '<a style="margin-right: 5%;" title="Editar" id="editarTelefone" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html = '<a title="Remover" id="deleteAlunoTurma" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
            # Recuperando os dados da requisição
            $data = $request->all();

            # Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            # Executando a ação
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
            # Recuperando os dados da requisição
            $data = $request->all();

            # Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            # Executando a ação
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
            # Executando a ação
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
    public function getTurma(Request $request)
    {

        $tipos = \DB::table('turmas')
            ->select('turmas.id', 'turmas.nome')
            ->get();

        return response()->json($tipos);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDadosTurma(Request $request)
    {
        $dados = $request->request->all();

        $tipos = \DB::table('turmas')
            ->select('turmas.id', 'turmas.nome')
            ->get();

        return response()->json($tipos);

    }

}
