<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\CurriculoRepository;
use SerEducacional\Services\CurriculoService;
use SerEducacional\Validators\CurriculoValidator;
use Yajra\Datatables\Datatables;


class CurriculosController extends Controller
{
    /**
     * @var CurriculoRepository
     */
    protected $repository;

    /**
     * @var CurriculoValidatorValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Curso',
        'Turno',
        'Serie'
    ];

    /**
     * @var CurriculoService
     */
    private $service;

    /**
     * CurriculosController constructor.
     * @param CurriculoRepository $repository
     * @param CurriculoValidator $validator
     * @param CurriculoService $service
     */
    public function __construct(CurriculoRepository $repository,
                                CurriculoValidator $validator,
                                CurriculoService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Retorno para view
        return view('curriculo.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('curriculos')
            ->join('cursos', 'cursos.id', '=', 'curriculos.curso_id')
            ->select([
                'curriculos.id',
                'curriculos.nome',
                'curriculos.codigo',
                'cursos.codigo as codigo_curso',
                \DB::raw('IF(curriculos.ativo = 1, "SIM", "NÃO") as ativo')
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # recuperando o curriculo
            $curriculo = $this->repository->find($row->id);

            # Html do edit
            $html  = '<a style="margin-right: 5%;" title="Editar Currículo"  href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';

            # Recuperando as disciplinas
            $disciplinas = \DB::table('disciplinas')
                ->join('curriculos_series_disciplinas', 'curriculos_series_disciplinas.disciplina_id', '=', 'disciplinas.id')
                ->join('curriculos_series', 'curriculos_series.id', '=', 'curriculos_series_disciplinas.curriculo_serie_id')
                ->join('curriculos', 'curriculos.id', '=', 'curriculos_series.curriculo_id')
                ->where('curriculos.id', $curriculo->id)
                ->select(['disciplinas.id'])->get();

            # Verificando se o currículo possui disciplinas
            if(count($disciplinas) == 0) {
                # Html de delete
                $html .= '<a style="margin-right: 5%;" title="Remover Currículo" href="destroy/'.$row->id.'"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Html de adicionar disciplina
            $html .= '<a title="Adicionar Disciplina" id="btnModalAdicionarDisciplinas" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            
            # Retorno
            return $html;
        })->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('curriculo.create', compact('loadFields'));
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
        } catch (\Throwable $e) { 
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
            $model = $this->repository->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            # Recuperando o ranger de séries
            $serieInicial = $model->series->first();
            $serieFinal   = $model->series->last();

            #retorno para view
            return view('curriculo.edit', compact('model', 'loadFields', 'serieInicial', 'serieFinal'));
        } catch (\Throwable $e) {
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

            #tratando as rules
            $this->validator->replaceRules(ValidatorInterface::RULE_UPDATE, ":id", $id);

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            #Executando a ação
            $this->service->update($data, $id);

            #Retorno para a view
            return redirect()->back()->with("message", "Alteração realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
