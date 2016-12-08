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

class ServidorController extends Controller
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
        $servidor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $servidor,
            ]);
        }

        return view('servidor.show', compact('servidor'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $servidor = $this->repository->find($id);

        return view('servidor.edit', compact('servidor'));
    }

    /**
     * @param PessoaFisicaUpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(ServidorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $servidor = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Servidor updated.',
                'data'    => $servidor->toArray(),
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
                'message' => 'Servidor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Servidor deleted.');
    }
}