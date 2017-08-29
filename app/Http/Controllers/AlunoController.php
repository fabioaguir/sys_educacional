<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
/*use SerEducacional\Http\Requests\AlunoCreateRequest;
use SerEducacional\Http\Requests\AlunoUpdateRequest;*/
use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Services\AlunoService;
use SerEducacional\Validators\AlunoValidator;
use Yajra\Datatables\Datatables;


class AlunoController extends Controller
{
    /**
     * @var AlunoRepository
     */
    protected $repository;

    /**
     * @var AlunoValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Estado',
        'Cidade',
        'Bairro',
        'Nacionalidade',
        'Zona',
        'Sexo'
    ];

    /**
     * @var AlunoService
     */
    private $service;

    /**
     * CargosController constructor.
     * @param AlunoRepository $repository
     * @param AlunoValidator $validator
     * @param AlunoService $service
     */
    public function __construct(AlunoRepository $repository,
                                AlunoValidator $validator,
                                AlunoService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        # Retorno para view
        return view('aluno.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('edu_alunos')
            ->leftJoin('edu_historico', function ($join) {
                $join->on(
                    'edu_historico.id', '=',
                    \DB::raw('(SELECT edu_historico.id FROM edu_historico
                        where edu_historico.aluno_id = edu_alunos.id ORDER BY edu_historico.id DESC LIMIT 1)')
                );
            })
            ->leftJoin('edu_escola', 'edu_escola.id', '=', 'edu_historico.escola_id')
            ->leftJoin('edu_series', 'edu_series.id', '=', 'edu_historico.serie_id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->select([
                'edu_alunos.id',
                'edu_alunos.codigo',
                'gen_cgm.nome',
                'gen_cgm.data_nascimento',
                'gen_cgm.mae',
                'edu_historico.situacao_matricula_id as situacao',
                'edu_escola.id as escola_id',
                'edu_series.id as serie_id',
                'edu_historico.id as matricula',
                'edu_historico.turma_id as turma_id'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recupernado o usuário
            $user = Auth::user();

            # Recuperando a aluno
            $aluno = $this->repository->find($row->id);

            # Variáveis de uso
            $html  = '<div class="fixed-action-btn horizontal">';
            $html .= '<a class="btn-floating btn-main"><i class="large material-icons">dehaze</i></a><ul>';

            # Verificando a permissão de edição
            if($user->can('aluno.update')) {
                $html .= '<li><a class="btn-floating" href="edit/'.$row->id.'" title="Editar Aluno"><i class="material-icons">edit</i></a></li>';
            }

            # Verificando a permissão de remoção
            if(count($aluno->matricula) == 0 && $user->can('aluno.destroy')) {
                $html .= '<li><a class="btn-floating" href="destroy/'.$row->id.'" title="Remover Aluno"><i class="material-icons">delete</i></a></li>';
            }

            # Html de histórico de matrícula
            $html .= '<li><a id="btnModalHistoricoAluno" class="btn-floating" title="Histórico de matrícula"><i class="material-icons">storage</i></a></li>';

            # Verificando a permissão da matrícula
            if($user->can('aluno.matricula') && ($row->situacao != "1")) {
                # Html de adicionar alunos em turma
                $html .= '<li><a id="btnModalAdicionarAlunoTurma" class="btn-floating" title="Matricular"><i class="material-icons">school</i></a></li>';
            }

            # Html de mudança de turma
            if($row->matricula && $row->situacao == "1") {
                $html .= '<li><a id="btnModalMudarTurma" class="btn-floating" title="Mudança de turma"><i class="material-icons">redo</i></a></li>';
            }

            $html .= '</ul></div>';

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
        return view('aluno.create', compact('loadFields'));
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
            #Recuperando o aluno
            $model = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('aluno.edit', compact('model', 'loadFields'));
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
        } catch (\Throwable $e) { dd($e);
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCidade(Request $request)
    {
        $idEstado = $request->get('id');

        $cidades = \DB::table('gen_cidades')
            ->join('gen_estados', 'gen_estados.id', '=', 'gen_cidades.estados_id')
            ->select('gen_cidades.id', 'gen_cidades.nome')
            ->where('gen_estados.id', $idEstado)
            ->get();

        return response()->json($cidades);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function findBairro(Request $request)
    {
        $idCidade = $request->get('id');

        $cidades = \DB::table('gen_bairros')
            ->join('gen_cidades', 'gen_cidades.id', '=', 'gen_bairros.cidades_id')
            ->select('gen_bairros.id', 'gen_bairros.nome')
            ->where('gen_cidades.id', $idCidade)
            ->get();

        return response()->json($cidades);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchCpf(Request $request)
    {
        try {
            #Declaração de variável de uso
            $result = false;
            #Dados vindo na requisição
            $dados = $request->all();

            #
            if (empty($dados['idModel'])) {
                #Consultando
                $aluno = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.cpf'
                    ])
                    ->where('gen_cgm.cpf', $dados['value'])
                    ->get();

            } else {
                #Consultando
                $aluno = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.id',
                        'gen_cgm.cpf'
                    ])
                    ->where('gen_cgm.id', '!=' ,$dados['idModel'])
                    ->where('gen_cgm.cpf', $dados['value'])
                    ->get();
            }

            if (count($aluno)) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }
}