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


class FrequenciaController extends Controller
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

        # Retorno para view
        return view('turma.frequencia.create', compact('idTurma', 'professores'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDisciplinas(Request $request)
    {
        $dados = $request->all();

        #Carregando os dados para o cadastro
        $disciplinas = $this->service->getDisciplinas($dados);

        return response()->json($disciplinas);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function consultar(Request $request)
    {

        #Carregando os dados para o cadastro
        $return = $this->service->consultar($request->request->all());

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
            $this->service->store($data);

            #Retorno para a view
            return redirect()->back()->with("message", "Frequência realizada com sucesso!");
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
