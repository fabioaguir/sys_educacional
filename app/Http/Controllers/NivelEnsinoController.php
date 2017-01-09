<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\NivelEnsinoRepository;
use SerEducacional\Repositories\CursoRepository;
use SerEducacional\Validators\NivelEnsinoValidator;
use SerEducacional\Services\NivelEnsinoService;
use Yajra\Datatables\Datatables;

class NivelEnsinoController extends Controller
{
    /**
     * @var NivelEnsinoRepository
     */
    protected $repository;

    /**
     * @var CursoRepository
     */
    protected $cursoRepository;

    /**
     * @var array
     */
    private $loadFields = [
        'ModalidadeEnsino'
    ];

    /**
     * @var NivelEnsinoService
     */
    private $service;

    /**
     * NivelEnsinoController constructor.
     * @param NivelEnsinoRepository $repository
     * @param NivelEnsinoService $service
     */
    public function __construct(NivelEnsinoRepository $repository,
                                CursoRepository $cursoRepository,
                                NivelEnsinoService $service,
                                NivelEnsinoValidator $validator)
    {
        $this->repository = $repository;
        $this->cursoRepository = $cursoRepository;
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        # Retorno para view
        return view('nivelEnsino.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        # Retorno para view
        return view('nivelEnsino.create', compact('loadFields'));
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('niveis_ensino')
            ->join('modalidades', 'modalidades.id', '=', 'niveis_ensino.modalidade_id')
            ->select([
                'niveis_ensino.id',
                'niveis_ensino.nome',
                'niveis_ensino.codigo',
                'modalidades.nome as modalidade',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            #verificando se existe vinculo com outra tabela (servidores)
            $curso = $this->cursoRepository->findWhere(['nivel_ensino_id' => $row->id]);

            #html de uso
            $html = '';

            # Verificando a permissão de editar
            if($user->can('nivel.update')) {
                $html  = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
            }

            #condição para que habilite a opção de remover
            if (count($curso) == 0 && $user->can('nivel.destroy')) {
                $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

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
            return view('nivelEnsino.edit', compact('model', 'loadFields'));
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
     * @return mixed
     */
    public function uniqueNome(Request $request)
    {
        try {
            #Declaração de variável de uso
            $result = false;
            #Dados vindo na requisição
            $nivelEnsino = $request->all();

            //dd($modalidadeEnsino);

            #
            if (empty($nivelEnsino['idModel'])) {
                #Consultando
                $nivel = \DB::table('niveis_ensino')
                    ->select([
                        'niveis_ensino.nome'
                    ])
                    ->where('niveis_ensino.nome', $nivelEnsino['value'])
                    ->get();

            } else {
                #Consultando
                $nivel = \DB::table('niveis_ensino')
                    ->select([
                        'niveis_ensino.id',
                        'niveis_ensino.nome'
                    ])
                    ->where('niveis_ensino.id', '!=', $nivelEnsino['idModel'])
                    ->where('niveis_ensino.nome', $nivelEnsino['value'])
                    ->get();
            }

            if (count($nivel) > 0 ) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function uniqueCodigo(Request $request)
    {
        try {
            #Declaração de variável de uso
            $result = false;
            #Dados vindo na requisição
            $nivelEnsino = $request->all();

            #
            if (empty($nivelEnsino['idModel'])) {
                #Consultando
                $nivel = \DB::table('niveis_ensino')
                    ->select([
                        'niveis_ensino.codigo'
                    ])
                    ->where('niveis_ensino.codigo', $nivelEnsino['value'])
                    ->get();

            } else {
                #Consultando
                $nivel = \DB::table('niveis_ensino')
                    ->select([
                        'niveis_ensino.id',
                        'niveis_ensino.codigo'
                    ])
                    ->where('niveis_ensino.id', '!=', $nivelEnsino['idModel'])
                    ->where('niveis_ensino.codigo', $nivelEnsino['value'])
                    ->get();
            }

            if (count($nivel) > 0 ) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }
}
