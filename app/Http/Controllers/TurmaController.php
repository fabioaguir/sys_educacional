<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\TurmaRepository;
use SerEducacional\Services\TurmaService;
use SerEducacional\Validators\TurmaValidator;
use Yajra\Datatables\Datatables;


class TurmaController extends Controller
{
    /**
     * @var TurmaRepository
     */
    protected $repository;

    /**
     * @var TurmaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Curso',
        'Turno',
        'Serie',
        'Curriculo',
        'FormaAvaliacao',
        'Calendario',
        'TipoAtendimento',
        'Dependencia',
        'Escola'
    ];

    /**
     * @var TurmaService
     */
    private $service;

    /**
     * TurmaController constructor.
     * @param TurmaRepository $repository
     * @param TurmaValidator $validator
     * @param TurmaService $service
     */
    public function __construct(TurmaRepository $repository,
                                TurmaValidator $validator,
                                TurmaService $service)
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
        return view('turma.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('turmas')
            ->join('escola', 'escola.id', '=', 'turmas.escola_id')
            ->join('tipos_atendimentos', 'tipos_atendimentos.id', '=', 'turmas.tipo_atendimento_id')
            ->join('calendarios', 'calendarios.id', '=', 'turmas.calendario_id')
            ->join('cursos', 'cursos.id', '=', 'turmas.curso_id')
            ->join('curriculos', 'curriculos.id', '=', 'turmas.curriculo_id')
            ->join('series', 'series.id', '=', 'turmas.serie_id')
            ->join('formas_avaliacoes', 'formas_avaliacoes.id', '=', 'turmas.forma_avaliacao_id')
            ->join('dependencias', 'dependencias.id', '=', 'turmas.dependencia_id')
            ->join('turnos', 'turnos.id', '=', 'turmas.turno_id')
            ->where('turmas.tipo_turma_id', 1)
            ->select([
                'turmas.id',
                'turmas.nome',
                'turmas.codigo',
                'escola.codigo as escola',
                'escola.id as escola_id',
                'cursos.codigo as curso',
                'curriculos.codigo as curriculo',
                'turnos.nome as turno',
                'turnos.id as turno_id',
                'series.id as serie_id'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # recuperando o curriculo
            $turma = $this->repository->find($row->id);

            # Variável de uso
            $html = '';

            # Verificando a permissão de editar
            if($user->can('turma.update')) {
                # Html do edit
                $html  = '<a style="margin-right: 5%;" title="Editar Currículo"  href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Verificando se o currículo possui disciplinas
            if(count($turma->pareceres) == 0 && $user->can('turma.destroy')) {
                # Html de delete
                $html .= '<a style="margin-right: 5%;" title="Remover Currículo" href="destroy/'.$row->id.'"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Verificando a permissão das disciplinas
            if($user->can('turma.disciplina')) {
                # Html de disciplinas
                $html .= '<a style="margin-right: 5%;" title="Disciplinas" id="btnModalDisciplinas" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            }

            # Verificando a permissão dos alunos
            if($user->can('turma.aluno')) {
                # Html de alunos
                $html .= '<a style="margin-right: 5%;" title="Alunos" id="btnModalAlunos" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            }

            # Verificando a permissão dos pareceres
            if($user->can('turma.parecer')) {
                # Html de pareceres
                $html .= '<a title="Pareceres" id="btnModalPareceres" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            }

            # Verificando a permissão dos pareceres
            
            # Html de horários
            $html .= '<a title="Horários" id="btnModalHorarios" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            

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
        return view('turma.create', compact('loadFields'));
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

            #retorno para view
            return view('turma.edit', compact('model', 'loadFields'));
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

    /**
     * @param $idCurso
     * @return mixed
     */
    public function searchCurriculosByCurso($idCurso)
    {
        try {
            # Consulta ao banco de dados
            $result = \DB::table('curriculos')
                ->join('cursos', 'cursos.id', '=', 'curriculos.curso_id')
                ->where('cursos.id', $idCurso)
                ->select([
                    'curriculos.id',
                    'curriculos.nome'
                ])
                ->get();

            # Retorno
            return \Illuminate\Support\Facades\Response::json($result);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param $idCurriculo
     * @return mixed
     */
    public function searchSeriesByCurriculo($idCurriculo)
    {
        try {
            # Consulta ao banco de dados
            $result = \DB::table('series')
                ->join('curriculos_series', 'curriculos_series.serie_id', '=', 'series.id')
                ->join('curriculos', 'curriculos.id', '=', 'curriculos_series.curriculo_id')
                ->where('curriculos.id', $idCurriculo)
                ->select([
                    'series.id',
                    'series.nome'
                ])
                ->get();

            # Retorno
            return \Illuminate\Support\Facades\Response::json($result);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
