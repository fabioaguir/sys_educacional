<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\UserRepository;
use SerEducacional\Services\UserService;
use SerEducacional\Validators\UserValidator;
use SerEducacional\Validators\UserAlterarSenhaValidator;
use Yajra\Datatables\Datatables;


class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Role|resolvedName',
        'TipoUsuario'
    ];

    /**
     * @var UserService
     */
    private $service;

    /**
     * UserController constructor.
     * @param UserRepository $repository
     * @param UserValidator $validator
     * @param UserService $service
     */
    public function __construct(UserRepository $repository,
                                UserValidator $validator,
                                UserAlterarSenhaValidator $alterarSenha,
                                UserService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->alterarSenha = $alterarSenha;
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
        return view('user.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('users')
            ->select([
                'users.id',
                'users.name',
                'users.email'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # Variáveis de uso
            $html = '';

            # Verificando a permissão de editar
            if($user->can('user.update')) {
                $html  = '<a style="margin-right: 5%;" title="Editar usuário" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Verificando a permissão de remorção
            if($user->can('user.destroy')) {
                //$html .= '<a href="destroy/'.$row->id.'" title="Remover usuário" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
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
        return view('user.create', compact('loadFields'));
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
            #Recuperando a empresa
            $model = $this->repository->with(['servidor.cgm'])->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('user.edit', compact('model', 'loadFields'));
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function alterarSenha()
    {
        return view('user.alterarSenha');
    }

    /**
     * Metrodo que faz a checagem da senha do usuário antes de alterar em 'alterar senha'
     */
    public function searchSenha(Request $request)
    {
        try{
            #Declaração de variável de uso
            $result = true;

            #Dados vindo na requisição
            $dados = $request->all();

            #Comparando senha inserida no formulário com a senha salva no banco
            if (Hash::check($dados['value'], Auth::user()->password)) {
                $result = false;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function novaSenha(Request $request)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #tratando as rules
            $this->alterarSenha->replaceRules(ValidatorInterface::RULE_UPDATE, ":id", $data['idUsuario']);

            #Validando a requisição
            $this->alterarSenha->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            #Executando a ação
            $this->service->atualizarSenha($data);

            #Retorno para a view
            return redirect()->back()->with("message", "Alteração realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
