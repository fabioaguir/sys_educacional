<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\PeriodoAvaliacaoCreateRequest;
use SerEducacional\Http\Requests\PeriodoAvaliacaoUpdateRequest;
use SerEducacional\Repositories\PeriodoAvaliacaoRepository;
use SerEducacional\Validators\PeriodoAvaliacaoValidator;
use SerEducacional\Services\PeriodoAvaliacaoService;
use Yajra\Datatables\Datatables;
use SerEducacional\Uteis\SerbinarioDateFormat;


class PeriodoAvaliacaosController extends Controller
{
    /**
     * @var PeriodoAvaliacaoRepository
     */
    protected $repository;

    /**
     * @var PeriodoAvaliacaoService
     */
    private $service;

    /**
     * @var PeriodoAvaliacaoValidator
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
     * PeriodoAvaliacaosController constructor.
     * @param PeriodoAvaliacaoRepository $repository
     * @param PeriodoAvaliacaoService $service
     * @param PeriodoAvaliacaoValidator $validator
     */
    public function __construct(PeriodoAvaliacaoRepository $repository,
                                PeriodoAvaliacaoService $service,
                                PeriodoAvaliacaoValidator $validator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function grid($id)
    {
        #Criando a consulta
        $rows = \DB::table('edu_periodos_avaliacao')
            ->join('edu_periodos', 'edu_periodos.id', '=', 'edu_periodos_avaliacao.periodos_id')
            ->join('edu_calendarios', 'edu_calendarios.id', '=', 'edu_periodos_avaliacao.calendarios_id')
            ->where('edu_periodos_avaliacao.calendarios_id', '=', $id)
            ->select([
                'edu_periodos_avaliacao.id as id',
                'edu_periodos.nome as periodo',
                \DB::raw('DATE_FORMAT(edu_periodos_avaliacao.data_inicial,"%d/%m/%Y") as data_inicial'),
                \DB::raw('DATE_FORMAT(edu_periodos_avaliacao.data_final,"%d/%m/%Y") as data_final'),
                \DB::raw('DATE_FORMAT(edu_periodos_avaliacao.data_fechamento,"%d/%m/%Y") as data_fechamento'),
                'edu_periodos_avaliacao.dias_letivos',
                'edu_periodos_avaliacao.semanas_letivas',
                'edu_calendarios.dias_letivos as total_dias',
                'edu_calendarios.semanas_letivas as total_semanas',
                'edu_periodos.id as periodo_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Variáveis de uso
            $html  = '<a style="margin-right: 5%;" id="editarPeriodo" title="Editar" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a title="Remover" id="deletePeriodo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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

            //dd($data);

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPeriodo(Request $request)
    {

        $periodos = \DB::table('edu_periodos')
            ->select('edu_periodos.id', 'edu_periodos.nome')
            ->get();

        return response()->json($periodos);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validarDataCalendario(Request $request)
    {

        #recuperando o id do calendário
        $idCalendario = $request->get('idCalendario');

        // Validando se o campo data existe e está vazio
        if($request->has('data') && $request->get('data') != "") {
            #recuperando a data incial e transformando no formanto americano
            $data = SerbinarioDateFormat::toUsa($request->get('data'));

            // Validando de a data está entre o período do calendário
            $query = \DB::table('edu_calendarios')
                ->where('edu_calendarios.id', '=', $idCalendario)
                ->where('edu_calendarios.data_inicial', '<=', $data)
                ->where('edu_calendarios.data_final', '>=', $data)
                ->first();

            // Valida se o retorno da quary foi nula ou não
            $retorno = $query == null ? 0 : 1;

        } else {
            $retorno = 2;
        }
        
        return response()->json($retorno);

    }
}
