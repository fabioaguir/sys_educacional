<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\NotaParecerRepository;
use SerEducacional\Services\NotaParecerService;
use SerEducacional\Validators\NotaParecerValidator;
use Yajra\Datatables\Datatables;


class NotaParecerController extends Controller
{

    /**
     * @var NotaParecerRepository
     */
    protected $repository;

    /**
     * @var NotaParecerValidator
     */
    protected $validator;

    /**
     * @var NotaParecerService
     */
    private $service;

    /**
     * @var array
     */
    private $loadFields = [];

    public function __construct(NotaParecerRepository $repository,
                                NotaParecerValidator $validator,
                                NotaParecerService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
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

        $alunos = $loadFields['alunos'];
        $periodos = $loadFields['periodos'];

        # Retorno para view
        return view('turma.nota-parecer.create', compact('alunos', 'periodos', 'idTurma'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function consultar(Request $request)
    {

        #Carregando os dados para o cadastro
        $return = $this->service->consultar($request->request->all());

        return \Illuminate\Support\Facades\Response::json(['return' => $return]);
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
            $return = $this->service->store($data);

            #Retorno para a view
            return \Illuminate\Support\Facades\Response::json(['return' => $return]);
        } catch (ValidatorException $e) {
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

}
