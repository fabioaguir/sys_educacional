<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\ModalidadeEnsinoRepository;
use SerEducacional\Repositories\NivelEnsinoRepository;
use SerEducacional\Validators\ModalidadeEnsinoValidator;
use SerEducacional\Services\ModalidadeEnsinoService;
use Yajra\Datatables\Datatables;

class ModalidadeEnsinoController extends Controller
{

    /**
     * @var ModalidadeEnsinoRepository
     */
    protected $repository;

    /**
     * @var array3
     */
    private $loadFields = [

    ];

    /**
     * @var ModalidadeEnsinoService
     */
    private $service;

    /**
     * ModalidadeEnsinoController constructor.
     * @param ModalidadeEnsinoRepository $repository
     * @param ModalidadeEnsinoService $service
     */
    public function __construct(ModalidadeEnsinoRepository $repository,
                                NivelEnsinoRepository $nivelEnsinoRepository,
                                ModalidadeEnsinoService $service,
                                ModalidadeEnsinoValidator $validator)
    {
        $this->repository = $repository;
        $this->nivelEnsinoRepository = $nivelEnsinoRepository;
        $this->service = $service;
        $this->validator = $validator;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        # Retorno para view
        return view('modalidade.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        # Retorno para view
        return view('modalidade.create');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('modalidades')
            ->select([
                'modalidades.id',
                'modalidades.nome',
                'modalidades.codigo',
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {

            #verificando se existe vinculo com outra tabela (servidores)
            $nivelEnsino = $this->nivelEnsinoRepository->findWhere(['modalidade_id' => $row->id]);

            #botão editar
            $html  = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';

            #condição para que habilite a opção de remover
            if (count($nivelEnsino) == 0) {
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
            return view('modalidade.edit', compact('model', 'loadFields'));
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
            $modalidadeEnsino = $request->all();

            //dd($modalidadeEnsino);

            #
            if (empty($modalidadeEnsino['idModel'])) {
                #Consultando
                $modalidadeNome = \DB::table('modalidades')
                    ->select([
                        'modalidades.nome'
                    ])
                    ->where('modalidades.nome', $modalidadeEnsino['value'])
                    ->get();

            } else {
                #Consultando
                $modalidadeNome = \DB::table('modalidades')
                    ->select([
                        'modalidades.id',
                        'modalidades.nome'
                    ])
                    ->where('modalidades.id', '!=', $modalidadeEnsino['idModel'])
                    ->where('modalidades.nome', $modalidadeEnsino['value'])
                    ->get();
            }

            if (count($modalidadeNome) > 0 ) {
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
            $modalidadeEnsino = $request->all();

            #
            if (empty($modalidadeEnsino['idModel'])) {
                #Consultando
                $modalidadeEnsino = \DB::table('modalidades')
                    ->select([
                        'modalidades.codigo'
                    ])
                    ->where('modalidades.codigo', $modalidadeEnsino['value'])
                    ->get();

            } else {
                #Consultando
                $modalidadeEnsino = \DB::table('modalidades')
                    ->select([
                        'modalidades.id',
                        'modalidades.codigo'
                    ])
                    ->where('modalidades.id', '!=', $modalidadeEnsino['idModel'])
                    ->where('modalidades.codigo', $modalidadeEnsino['value'])
                    ->get();
            }

            if (count($modalidadeEnsino) > 0 ) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }
}
