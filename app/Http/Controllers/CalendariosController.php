<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
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
        $rows = \DB::table('edu_calendarios')
            ->join('edu_duracoes', 'edu_duracoes.id', '=', 'edu_calendarios.duracoes_id')
            ->join('edu_status', 'edu_status.id', '=', 'edu_calendarios.status_id')
            ->select([
                'edu_calendarios.id',
                'edu_calendarios.nome as nome',
                \DB::raw('DATE_FORMAT(edu_calendarios.data_inicial,"%d/%m/%Y") as data_inicial'),
                \DB::raw('DATE_FORMAT(edu_calendarios.data_final,"%d/%m/%Y") as data_final'),
                \DB::raw('DATE_FORMAT(edu_calendarios.data_resultado_final,"%d/%m/%Y") as data_resultado_final'),
                'edu_calendarios.dias_letivos',
                'edu_calendarios.semanas_letivas',
                'edu_calendarios.ano',
                'edu_status.nome as status',
                'edu_duracoes.nome as duracao',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();


            # Recuperando a calendario
            $calendario = $this->repository->find($row->id);

            # Variáveis de uso
            $html  = '';

            # Verificando a permissão de editar
            if($user->can('calendario.update')) {
                $html  = '<a style="margin-right: 5%;" title="Editar" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Verificando a permissão e possibilidade de exclusão
            if(count($calendario->periodoAvaliacao) == 0 && count($calendario->evento) == 0 && $user->can('calendario.destroy')) {
                $html .= '<a style="margin-right: 5%;" href="destroy/'.$row->id.'" title="Remover" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Verificando a permissão de adicionar período de avaliação
            if($user->can('calendario.add.periodo')) {
                # Html de adicionar período de avaliação
                $html .= '<a style="margin-right: 5%;" title="Adicionar Período de Avaliação" id="btnModalAdicionarPeriodo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            }

            # Verificando a permissão de adicionar evento
            if($user->can('calendario.add.evento')) {
                # Html de adicionar eventos
                $html .= '<a title="Adicionar Evento" id="btnModalAdicionarEvento" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            }
            
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
