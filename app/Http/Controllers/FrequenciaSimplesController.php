<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\FrequenciaRepository;
use SerEducacional\Services\FrequenciaService;
use SerEducacional\Validators\FrequenciaValidator;
use Yajra\Datatables\Datatables;


class FrequenciaSimplesController extends Controller
{

    /**
     * @var FrequenciaRepository
     */
    protected $repository;

    /**
     * @var FrequenciaValidator
     */
    protected $validator;

    /**
     * @var FrequenciaService
     */
    private $service;

    /**
     * @var array
     */
    private $loadFields = [];

    /**
     * @param FrequenciaRepository $repository
     * @param FrequenciaValidator $validator
     * @param FrequenciaService $service
     */
    public function __construct(FrequenciaRepository $repository,
                                FrequenciaValidator $validator,
                                FrequenciaService $service)
    {
        $this->repository   = $repository;
        $this->validator    = $validator;
        $this->service      = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idTurma)
    {

        #Carregando os dados para o cadastro
        $loadFields = $this->service->loadFields($idTurma);

        $professores = $loadFields;

        $turma = \DB::table('edu_turmas')->where('id', $idTurma)->first();

        # Retorno para view
        return view('turma.frequencia-simples.create', compact('idTurma', 'professores', 'turma'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function consultar(Request $request)
    {

        #Carregando os dados para o cadastro
        $return = $this->service->consultarByFrequenciaSimples($request->request->all());

        return \Illuminate\Support\Facades\Response::json($return);
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

            #Executando a ação
            $this->service->storeByFrequenciaSimples($data);

            #Retorno para a view
            return redirect()->back()->with("message", "Frequência realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
