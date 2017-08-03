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
        $rows = \DB::table('edu_turmas')
            ->join('edu_escola', 'edu_escola.id', '=', 'edu_turmas.escola_id')
            ->join('edu_tipos_atendimentos', 'edu_tipos_atendimentos.id', '=', 'edu_turmas.tipo_atendimento_id')
            ->join('edu_calendarios', 'edu_calendarios.id', '=', 'edu_turmas.calendario_id')
            ->join('edu_cursos', 'edu_cursos.id', '=', 'edu_turmas.curso_id')
            ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_turmas.curriculo_id')
            ->join('edu_series', 'edu_series.id', '=', 'edu_turmas.serie_id')
            ->join('edu_formas_avaliacoes', 'edu_formas_avaliacoes.id', '=', 'edu_turmas.forma_avaliacao_id')
            ->join('edu_dependencias', 'edu_dependencias.id', '=', 'edu_turmas.dependencia_id')
            ->join('edu_turnos', 'edu_turnos.id', '=', 'edu_turmas.turno_id')
            ->where('edu_turmas.tipo_turma_id', 1)
            ->select([
                'edu_turmas.id',
                'edu_turmas.nome',
                'edu_turmas.codigo',
                'edu_escola.codigo as escola',
                'edu_escola.id as escola_id',
                'edu_cursos.codigo as curso',
                'edu_curriculos.codigo as curriculo',
                'edu_turnos.nome as turno',
                'edu_turnos.id as turno_id',
                'edu_series.id as serie_id'
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
                $html  = '<a style="margin-right: 5%;" title="Editar Base Curricular"  href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Verificando se o currículo possui disciplinas
            if(count($turma->pareceres) == 0 && $user->can('turma.destroy')) {
                # Html de delete
                $html .= '<a style="margin-right: 5%;" title="Remover Base Curricular" href="destroy/'.$row->id.'"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
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
            $result = \DB::table('edu_curriculos')
                ->join('edu_cursos', 'edu_cursos.id', '=', 'edu_curriculos.curso_id')
                ->where('edu_cursos.id', $idCurso)
                ->select([
                    'edu_curriculos.id',
                    'edu_curriculos.nome'
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
            $result = \DB::table('edu_series')
                ->join('edu_curriculos_series', 'edu_curriculos_series.serie_id', '=', 'edu_series.id')
                ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_curriculos_series.curriculo_id')
                ->where('edu_curriculos.id', $idCurriculo)
                ->select([
                    'edu_series.id',
                    'edu_series.nome'
                ])
                ->get();

            # Retorno
            return \Illuminate\Support\Facades\Response::json($result);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['error' => $e->getMessage()]);
        }
    }
}
