<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\ServidorCreateRequest;
use SerEducacional\Http\Requests\ServidorUpdateRequest;
use SerEducacional\Repositories\ServidorRepository;
use SerEducacional\Validators\ServidorValidator;
use SerEducacional\Services\ServidorService;
use Yajra\Datatables\Datatables;

class ServidorController extends Controller
{
    /**
     * @var ServidorService
     */
    private $service;

    /**
     * @var ServidorRepository
     */
    protected $repository;

    /**
     * @var ServidorValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Sexo',
        'Nacionalidade',
        'CgmMunicipio',
        'EstadoCivil',
        'Nacionalidade',
        'Escolaridade',
        'Estado',
        'Cargo',
        'Funcao',
        'HabilitacaoEscolaridade',
        'TipoVinculo',
        'Situacao',
        'Alergia'
    ];

    /**
     * ServidorController constructor.
     * @param ServidorService $service
     * @param ServidorRepository $repository
     * @param ServidorValidator $validator
     */
    public function __construct(ServidorService $service,
                                ServidorRepository $repository,
                                ServidorValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('servidor.index');
    }


    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('edu_servidor')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_servidor.id_cgm')
            ->select([
                'edu_servidor.id',
                'gen_cgm.nome',
                'edu_servidor.matricula',
                'gen_cgm.id as cgm_id',
                'edu_servidor.carga_horaria'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # Recuperando a calendario
            $servidor = $this->repository->find($row->id);
            
            # Variáveis de uso
            $html = '<div class="fixed-action-btn horizontal">';
            $html .= '<a class="btn-floating btn-main"><i class="large material-icons">dehaze</i></a><ul>';

            # Verificando a permissão de edição
            if($user->can('servidor.update')) {
                $html .= '<li><a class="btn-floating" href="edit/'.$row->id.'" title="Editar Servidor"><i class="material-icons">edit</i></a></li>';
            }

            # Verificando a permissão de remorção
            if(count($servidor->cgm->telefones) == 0 && count($servidor->relacaoTrabalho) == 0 && $user->can('servidor.destroy') 
                && count($servidor->formacoes) == 0 && count($servidor->atividades) == 0 && count($servidor->alocacoes) == 0
                && count($servidor->disponibilidades) == 0) {
                $html .= '<li><a class="btn-floating" href="destroy/'.$row->id.'" title="Remover Servidor"><i class="material-icons">delete</i></a></li>';
            }

            # Verificando a permissão de adicionar telefone
            if($user->can('servidor.add.telefone')) {
                # Html de adicionar telefones
                $html .= '<li><a class="btn-floating" id="btnModalAdicionarTelefone" title="Adicionar Telefones"><i class="material-icons">phone</i></a></li>';
            }

            # Verificando a permissão de adicionar relações de trabalho
            if($user->can('servidor.add.relacao.trabalho')) {
                # Html de adicionar relações de trabalho
                $html .= '<li><a class="btn-floating" id="btnModalAdicionarRelacao" title="Adicionar Relação de trabalho"><i class="material-icons">work</i></a></li>';
            }

            # Verificando a permissão de adicionar formação
            if($user->can('servidor.add.formacao')) {
                # Html de adicionar formação
                $html .= '<li><a class="btn-floating" id="btnModalAdicionarFormacao" title="Adicionar Formações"><i class="material-icons">assignment</i></a></li>';
            }

            # Verificando a permissão de adicionar formação
            if($user->can('servidor.add.atividade')) {
                # Html de adicionar atividade
                $html .= '<li><a class="btn-floating" id="btnModalAdicionarAtividade" title="Adicionar Atividades"><i class="material-icons">folder</i></a></li>';
            }

            # Verificando a permissão de adicionar alocações
            if($user->can('servidor.add.alocacao')) {
                # Html de adicionar alocação
                $html .= '<li><a class="btn-floating" id="btnModalAdicionarAlocacao" title="Adicionar Alocações"><i class="material-icons">redo</i></a></li>';
            }

           
            # Html de adicionar disponibilidades
            //$html .= '<li><a class="btn-floating" id="btnModalAdicionarDisponibilidade" title="Adicionar Disponibilidades"><i class="material-icons">event</i></a></li>';


            $html .= '</ul></div>';

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
        return view('servidor.create', compact('loadFields'));
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

            /*#Validando a requisição
            $this->service->tratamentoCampos($data);*/
            
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
            #Recuperando o servidor
            $model = $this->repository->with('cgm.endereco.bairro.cidade.estado')->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('servidor.edit', compact('model', 'loadFields'));
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

            #Validando a requisição
            $this->service->tratamentoCampos($data);

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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Servidor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Servidor deleted.');
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
                $servidor = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.cpf'
                    ])
                    ->where('gen_cgm.cpf', $dados['value'])
                    ->get();

            } else {
                #Consultando
                $servidor = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.id',
                        'gen_cgm.cpf'
                    ])
                    ->where('gen_cgm.id', '!=' ,$dados['idModel'])
                    ->where('gen_cgm.cpf', $dados['value'])
                    ->get();
            }

            if (count($servidor)) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }
}