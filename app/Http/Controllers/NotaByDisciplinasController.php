<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\NotaRepository;
use SerEducacional\Validators\NotaValidator;
use SerEducacional\Services\NotaByDisciplinaService;
use Yajra\Datatables\Datatables;

class NotaByDisciplinasController extends Controller
{
    /**
     * @var NotaByDisciplinaService
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
     * @param NotaByDisciplinaService $service
     * @param NotaRepository $repository
     * @param NotaValidator $validator
     */
    public function __construct(NotaByDisciplinaService $service,
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

        return view('turma.notabydisciplina.create', compact('alunos', 'periodos', 'disciplinas', 'idTurma', 'turma'));
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
            return redirect()->back()->with("message", "Notas inseridas com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($this->validator->errors())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

}