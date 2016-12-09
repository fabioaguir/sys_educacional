<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\PessoaFisicaCreateRequest;
use SerEducacional\Http\Requests\PessoaFisicaUpdateRequest;
use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Validators\PessoaFisicaValidator;
use SerEducacional\Services\PessoaFisicaService;
use Yajra\Datatables\Datatables;

class PessoaFisicaController extends Controller
{
    /**
     * @var
     */
    private $service;

    /**
     * @var PessoaFisicaRepository
     */
    protected $repository;

    /**
     * @var PessoaFisicaValidator
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
        'Escolaridade',
        'Bairro',
        'CategoriaCnh',
        'Cidade'
    ];

    /**
     * PessoaFisicaController constructor.
     * @param PessoaFisicaService $service
     * @param PessoaFisicaRepository $repository
     * @param PessoaFisicaValidator $validator
     */
    public function __construct(PessoaFisicaService $service,
                                PessoaFisicaRepository $repository,
                                PessoaFisicaValidator $validator)
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
        return view('cgm.pessoaFisica.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('cgm.pessoaFisica.create', compact('loadFields'));
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('cgm')
            ->join('cgm_municipio', 'cgm.cgm_municipio_id', 'cgm_municipio.id')
            ->select([
                'cgm.id',
                'cgm.nome',
                'cgm.rg',
                'cgm.cpf',
                'cgm_municipio.nome as statusCgm'
            ])
            ->get();
        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })->make(true);
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
        } catch (\Throwable $e) {print_r($e->getMessage()); exit;
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $pessoaFisica = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pessoaFisica,
            ]);
        }

        return view('pessoaFisicas.show', compact('pessoaFisica'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            #Recuperando a empresa
            $model = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);
            //dd($model);
            #retorno para view
            return view('cgm.pessoaFisica.edit', compact('model', 'loadFields'));
        } catch (\Throwable $e) {dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param PessoaFisicaUpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
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

            #Retorno para a view
            return redirect()->back()->with("message", "Alteração realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
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
                'message' => 'PessoaFisica deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PessoaFisica deleted.');
    }
}