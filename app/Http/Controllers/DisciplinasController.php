<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\DisciplinaRepository;
use SerEducacional\Services\DisciplinaService;
use SerEducacional\Validators\DisciplinaValidator;
use Yajra\Datatables\Datatables;


class DisciplinasController extends Controller
{

    /**
     * @var DisciplinaRepository
     */
    protected $repository;

    /**
     * @var DisciplinaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [];

    /**
     * @var DisciplinaService
     */
    private $service;

    /**
     * DisciplinasController constructor.
     * @param DisciplinaRepository $repository
     * @param DisciplinaValidator $validator
     */
    public function __construct(DisciplinaRepository $repository,
                                DisciplinaValidator $validator,
                                DisciplinaService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Retorno para view
        return view('disciplina.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('edu_disciplinas')
            ->select([
                'edu_disciplinas.id',
                'edu_disciplinas.nome',
                'edu_disciplinas.codigo',
                'edu_disciplinas.carga_horaria'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # Variáveis de uso
            $html  = '';

            # Verificando a permissão de alterar
            if($user->can('disciplina.update')) {
                $html  = '<a style="margin-right: 5%;" title="Editar Disciplina" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Verificando a permissão de remover
            if($user->can('disciplina.destroy')) {
                $html .= '<a href="destroy/'.$row->id.'" title="Remover Disciplina" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
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
        return view('disciplina.create', compact('loadFields'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        # Recuperando o usuário autenticado
        $user = Auth::user();

        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            #Validando a requisição
            $this->service->tratamentoCampos($data);

            #Executando a ação
            $result = $this->service->store($data);

            # Log do sistema
            Log::info("Disciplina cadastrada com sucesso! {id: {$result->id}, nome: {$result->nome}} {'id': $user->id, 'email': $user->email}");

            #Retorno para a view
            return redirect()->back()->with("message", "Cadastro realizado com sucesso!");
        } catch (ValidatorException $e) {
            # Log do sistema
            Log::error("Ocorreu um erro: {$e->getMessage()}. Usuário {id: {$user->id} - email: {$user->email}}");

            # Retorno para view
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            # Log do sistema
            Log::error("Ocorreu um erro: {$e->getMessage()}. Usuário {id: {$user->id} - email: {$user->email}}");

            # Retorno para view
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
            #Recuperando a empresa
            $model = $this->repository->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('disciplina.edit', compact('model', 'loadFields'));
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
}
