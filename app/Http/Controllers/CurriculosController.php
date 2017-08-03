<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
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
        'Serie',
        'Disciplina',
        'Frequencia',
        'ControleFrequencia'
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
        $rows = \DB::table('edu_curriculos')
            ->join('edu_cursos', 'edu_cursos.id', '=', 'edu_curriculos.curso_id')
            ->select([
                'edu_curriculos.id',
                'edu_curriculos.nome',
                'edu_curriculos.codigo',
                'edu_cursos.codigo as codigo_curso',
                \DB::raw('IF(edu_curriculos.ativo = 1, "SIM", "NÃO") as ativo')
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # recuperando o curriculo
            $curriculo = $this->repository->find($row->id);

            # Html de retorno
            $html = "";

            if($user->can('curriculo.update')) {
                # Html do edit
                $html  .= '<a style="margin-right: 5%;" title="Editar Currículo"  href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Recuperando as disciplinas
            $disciplinas = \DB::table('edu_disciplinas')
                ->join('edu_curriculos_series_disciplinas', 'edu_curriculos_series_disciplinas.disciplina_id', '=', 'edu_disciplinas.id')
                ->join('edu_curriculos_series', 'edu_curriculos_series.id', '=', 'edu_curriculos_series_disciplinas.curriculo_serie_id')
                ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_curriculos_series.curriculo_id')
                ->where('edu_curriculos.id', $curriculo->id)
                ->select(['edu_disciplinas.id'])->get();

            # Verificando se o currículo possui disciplinas
            if(count($disciplinas) == 0 && $user->can('curriculo.destroy')) {
                # Html de delete
                $html .= '<a style="margin-right: 5%;" title="Remover Currículo" href="destroy/'.$row->id.'"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Validando a permissão
            if($user->can('curriculo.add.disciplina')) {
                # Html de adicionar disciplina
                $html .= '<a title="Adicionar Disciplina" id="btnModalAdicionarDisciplinas" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            }

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
