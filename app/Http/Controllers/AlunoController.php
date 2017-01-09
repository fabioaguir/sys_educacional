<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
/*use SerEducacional\Http\Requests\AlunoCreateRequest;
use SerEducacional\Http\Requests\AlunoUpdateRequest;*/
use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Services\AlunoService;
use SerEducacional\Validators\AlunoValidator;
use Yajra\Datatables\Datatables;


class AlunoController extends Controller
{
    /**
     * @var AlunoRepository
     */
    protected $repository;

    /**
     * @var AlunoValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Estado',
        'Cidade',
        'Bairro',
        'Nacionalidade',
        'Zona',
        'Sexo'
    ];

    /**
     * @var AlunoService
     */
    private $service;

    /**
     * CargosController constructor.
     * @param AlunoRepository $repository
     * @param AlunoValidator $validator
     * @param AlunoService $service
     */
    public function __construct(AlunoRepository $repository,
                                AlunoValidator $validator,
                                AlunoService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        # Retorno para view
        return view('aluno.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('alunos')
            ->join('cgm', 'cgm.id', '=', 'alunos.cgm_id')
            ->select([
                'alunos.id',
                'alunos.codigo',
                'cgm.nome',
                'cgm.data_nascimento',
                'cgm.mae'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recupernado o usuário
            $user = Auth::user();

            # Recuperando a aluno
            $aluno = $this->repository->find($row->id);

            # Variáveis de uso
            $html  = '';

            # Verificando a permissão de edição
            if($user->can('aluno.update')) {
                $html  = '<a style="margin-right: 5%;" title="Editar Aluno" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Verificando a permissão de remorção
            if(count($aluno->matricula) == 0 && $user->can('aluno.destroy')) {
                $html .= '<a style="margin-right: 5%;" href="destroy/'.$row->id.'" title="Remover Cargo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Verificando a permissão da matrícula
            if($user->can('aluno.matricula')) {
                # Html de adicionar alunos em turma
                $html .= '<a title="Matricular" id="btnModalAdicionarAlunoTurma" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-briefcase"></i></a>';
            }

            # Retorno
            return $html;
        })->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('aluno.create', compact('loadFields'));
    }

    /**
     * @param Request $request
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

            #Retorno para a view
            return redirect()->back()->with("message", "Cadastro realizado com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            #Recuperando o aluno
            $model = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('aluno.edit', compact('model', 'loadFields'));
        } catch (\Throwable $e) {dd($e);
            return redirect()->back()->with('message', $e->getMessage());
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

            #tratando as rules
            $this->validator->replaceRules(ValidatorInterface::RULE_UPDATE, ":id", $id);

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            #Executando a ação
            $this->service->update($data, $id);

            #Retorno para a view
            return redirect()->back()->with("message", "Alteração realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        } catch (\Throwable $e) { dd($e);
            return redirect()->back()->with('message', $e->getMessage());
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

            #Retorno para a view
            return redirect()->back()->with("message", "Remoção realizada com sucesso!");
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCidade(Request $request)
    {
        $idEstado = $request->get('id');

        $cidades = \DB::table('cidades')
            ->join('estados', 'estados.id', '=', 'cidades.estados_id')
            ->select('cidades.id', 'cidades.nome')
            ->where('estados.id', $idEstado)
            ->get();

        return response()->json($cidades);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function findBairro(Request $request)
    {
        $idCidade = $request->get('id');

        $cidades = \DB::table('bairros')
            ->join('cidades', 'cidades.id', '=', 'bairros.cidades_id')
            ->select('bairros.id', 'bairros.nome')
            ->where('cidades.id', $idCidade)
            ->get();

        return response()->json($cidades);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchCpf(Request $request)
    {
        try {
            #Declaração de variável de uso
            $result = false;
            #Dados vindo na requisição
            $dados = $request->all();

            #
            if (empty($dados['idModel'])) {
                #Consultando
                $aluno = \DB::table('cgm')
                    ->select([
                        'cgm.cpf'
                    ])
                    ->where('cgm.cpf', $dados['value'])
                    ->get();

            } else {
                #Consultando
                $aluno = \DB::table('cgm')
                    ->select([
                        'cgm.id',
                        'cgm.cpf'
                    ])
                    ->where('cgm.id', '!=' ,$dados['idModel'])
                    ->where('cgm.cpf', $dados['value'])
                    ->get();
            }

            if (count($aluno)) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }
}