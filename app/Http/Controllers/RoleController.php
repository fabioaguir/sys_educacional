<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use SerEducacional\Services\RoleService;
use SerEducacional\Validators\RoleValidator;
use Yajra\Datatables\Datatables;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $service;

    /**
     * @var RoleValidator
     */
    private $validator;

    
    /**
     * @var array
     */
    private $loadFields = [
        'Permission|resolvedName'
    ];

    /**
     * RoleController constructor.
     * @param RoleService $service
     */
    public function __construct(RoleService $service, RoleValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('role.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $roles = \DB::table('roles')->select(['id', 'name', 'description']);

        #Editando a grid
        return Datatables::of($roles)->addColumn('action', function ($role) {
            # Html de retorno
            $html = "";

            # Recuperando o usuário;
            $user = Auth::user();

            # Checando permissão
           // if($user->can('perfil.update')) {
                $html .= '<a href="edit/'.$role->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            //}
            
            return $html;
        })->make(true);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields['permission'] = \DB::table('permissions')->select('id', 'name', 'model', 'slug')->get();
        $loadFields['model'] = \DB::table('permissions')->groupBy('model')->orderBy('model')->pluck('model')->all();

        #Retorno para view
        return view('role.create', compact('loadFields'));
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
            #Recuperando a role
            $role = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields['permission'] = \DB::table('permissions')->select('id', 'name', 'model', 'slug')->get();
            $loadFields['model'] = \DB::table('permissions')->groupBy('model')->orderBy('model')->pluck('model')->all();

            #retorno para view
            return view('role.edit', compact('role', 'loadFields'));
        } catch (\Throwable $e) {
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
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) { 
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
