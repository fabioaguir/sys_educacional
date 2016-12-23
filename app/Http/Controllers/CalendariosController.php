<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\CalendarioCreateRequest;
use SerEducacional\Http\Requests\CalendarioUpdateRequest;
use SerEducacional\Repositories\CalendarioRepository;
use SerEducacional\Validators\CalendarioValidator;
use SerEducacional\Services\CalendarioService;
use Yajra\Datatables\Datatables;


class CalendariosController extends Controller
{
    /**
     * @var CalendarioRepository
     */
    protected $repository;

    /**
     * @var CalendarioService
     */
    private $service;

    /**
     * @var CalendarioValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Status',
        'Duracao'
    ];

    /**
     * CalendariosController constructor.
     * @param CalendarioRepository $repository
     * @param CalendarioService $service
     * @param CalendarioValidator $validator
     */
    public function __construct(CalendarioRepository $repository,
                                CalendarioService $service,
                                CalendarioValidator $validator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        # Retorno para view
        return view('calendario.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('calendario.create', compact('loadFields'));
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('calendarios')
            ->join('duracoes', 'duracoes.id', '=', 'calendarios.duracoes_id')
            ->join('status', 'status.id', '=', 'calendarios.status_id')
            ->select([
                'calendarios.id',
                'calendarios.nome as nome',
                \DB::raw('DATE_FORMAT(calendarios.data_inicial,"%d/%m/%Y") as data_inicial'),
                \DB::raw('DATE_FORMAT(calendarios.data_final,"%d/%m/%Y") as data_final'),
                \DB::raw('DATE_FORMAT(calendarios.data_resultado_final,"%d/%m/%Y") as data_resultado_final'),
                'calendarios.dias_letivos',
                'calendarios.semanas_letivas',
                'calendarios.ano',
                'status.nome as status',
                'duracoes.nome as duracao',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Variáveis de uso
            $html  = '<a style="margin-right: 5%;" title="Editar" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a style="margin-right: 5%;" href="destroy/'.$row->id.'" title="Remover" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

            # Html de adicionar período de avaliação
            $html .= '<a style="margin-right: 5%;" title="Adicionar Período de Avaliação" id="btnModalAdicionarPeriodo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';

            # Html de adicionar eventos
            $html .= '<a title="Adicionar Evento" id="btnModalAdicionarEvento" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            
            # Retorno
            return $html;
        })->make(true);
    }

    /**
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
            return view('calendario.edit', compact('model', 'loadFields'));
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
