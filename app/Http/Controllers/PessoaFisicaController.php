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
        'Nacionalidade',
        'Escolaridade',
        'Bairro'
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $pessoaFisica = $this->repository->find($id);

        return view('pessoaFisicas.edit', compact('pessoaFisica'));
    }

    /**
     * @param PessoaFisicaUpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(PessoaFisicaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pessoaFisica = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'PessoaFisica updated.',
                'data'    => $pessoaFisica->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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