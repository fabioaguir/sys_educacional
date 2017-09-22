<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\NotaRepository;
use SerEducacional\Validators\NotaValidator;
use SerEducacional\Services\NotaService;
use Yajra\Datatables\Datatables;

class NotaController extends Controller
{
    /**
     * @var NotaService
     */
    private $service;

    /**
     * @var NotaRepository
     */
    protected $repository;

    /**
     * @var NotaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'ControleFrequencia'
    ];

    /**
     * @param NotaService $service
     * @param NotaRepository $repository
     * @param NotaValidator $validator
     */
    public function __construct(NotaService $service,
                                NotaRepository $repository,
                                NotaValidator $validator)
    {
        $this->repository  = $repository;
        $this->validator   = $validator;
        $this->service     = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($idTurma)
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->loadFields($idTurma);

        $alunos = $loadFields['alunos'];
        $periodos = $loadFields['periodos'];
        $disciplinas = $loadFields['disciplinas'];

        $turma = \DB::table('edu_turmas')->where('id', $idTurma)->first();

        return view('turma.nota.create', compact('alunos', 'periodos', 'disciplinas', 'idTurma', 'turma'));
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
            $return = $this->service->store($data);

            #Retorno para a view
            return \Illuminate\Support\Facades\Response::json(['return' => $return]);
        } catch (ValidatorException $e) {
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

}