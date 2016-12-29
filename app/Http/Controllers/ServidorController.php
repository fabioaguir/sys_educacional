<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

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
        $rows = \DB::table('servidor')
            ->join('cgm', 'cgm.id', '=', 'servidor.id_cgm')
            ->select([
                'servidor.id',
                'cgm.nome',
                'servidor.matricula',
                'cgm.id as cgm_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Variáveis de uso
            $html  = '<a style="margin-right: 5%;" title="Editar Servidor" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a style="margin-right: 5%;" href="destroy/'.$row->id.'" title="Remover Servidor" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';

            # Html de adicionar telefones
            $html .= '<a style="margin-right: 5%;" title="Adicionar Telefones" id="btnModalAdicionarTelefone" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-earphone"></i></a>';

            # Html de adicionar relações de trabalho
            $html .= '<a style="margin-right: 5%;" title="Adicionar Relação de trabalho" id="btnModalAdicionarRelacao" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-lock"></i></a>';

            # Html de adicionar formação
            $html .= '<a style="margin-right: 5%;" title="Adicionar Formações" id="btnModalAdicionarFormacao" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-education"></i></a>';

            # Html de adicionar atividade
            $html .= '<a style="margin-right: 5%;" title="Adicionar Atividades" id="btnModalAdicionarAtividade" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-briefcase"></i></a>';

            # Html de adicionar alocação
            $html .= '<a title="Adicionar Alocações" id="btnModalAdicionarAlocacao" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-briefcase"></i></a>';

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

            #Validando a requisição
            $this->service->tratamentoCampos($data);
            
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
                $servidor = \DB::table('cgm')
                    ->select([
                        'cgm.cpf'
                    ])
                    ->where('cgm.cpf', $dados['value'])
                    ->get();

            } else {
                #Consultando
                $servidor = \DB::table('cgm')
                    ->select([
                        'cgm.id',
                        'cgm.cpf'
                    ])
                    ->where('cgm.id', '!=' ,$dados['idModel'])
                    ->where('cgm.cpf', $dados['value'])
                    ->get();
            }

            if (count($servidor) > 0 ) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }
}