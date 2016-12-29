<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
/*use SerEducacional\Http\Requests\PeriodoCreateRequest;
use SerEducacional\Http\Requests\PeriodoUpdateRequest;*/
use SerEducacional\Repositories\CalendarioRepository;
use SerEducacional\Repositories\PeriodoRepository;
use SerEducacional\Validators\PeriodoValidator;
use SerEducacional\Services\PeriodoService;
use Yajra\Datatables\Datatables;

class PeriodoController extends Controller
{
    /**
     * @var
     */
    private $service;

    /**
     * @var PeriodoRepository
     */
    protected $repository;

    /**
     * @var PeriodoRepository
     */
    protected $periodoRepository;

    /**
     * @var CalendarioRepository
     */
    protected $calendarioRepository;

    /**
     * @var PeriodoValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'ControleFrequencia'
    ];

    /**
     * PeriodoController constructor.
     * @param PeriodoService $service
     * @param PeriodoRepository $repository
     * @param PeriodoValidator $validator
     * @param CalendarioRepository $calendarioRepository
     * @param PeriodoRepository $periodoRepository
     */
    public function __construct(PeriodoService $service,
                                PeriodoRepository $repository,
                                PeriodoValidator $validator,
                                CalendarioRepository $calendarioRepository,
                                PeriodoRepository $periodoRepository)
    {
        $this->repository           = $repository;
        $this->periodoRepository    = $periodoRepository;
        $this->calendarioRepository = $calendarioRepository;
        $this->validator            = $validator;
        $this->service              = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('periodo.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('periodo.create', compact('loadFields'));
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('periodos')
            ->select([
                'id',
                'nome',
                'abreviatura',
                'soma_carga_horaria',
                'controle_frequencia',
                'ordenacao',
            ]);



        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {

            #verificando se existe vinculo com outra tabela (calendario e periodo)
//            $periodo    = $this->periodoRepository->findWhere(['id' => $row->periodo]);
//            $calendario = $this->calendarioRepository->findWhere(['id' => $row->calendario]);
            //dd($periodo);
            #botão editar
            $html  = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
            $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

            #condição para que habilite a opção de remover
            /*if (count($periodo) == 0 && count($calendario) == 0) {
                $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }*/

            # Retorno
            return $html;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            #Recuperando a empresa
            $model = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('periodo.edit', compact('model', 'loadFields'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            #Executando a ação
            $this->service->destroy($id);

            #Retorno para a view
            return redirect()->back()->with("message", "Remoção realizada com sucesso!");
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}