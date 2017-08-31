<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\EscolaRepository;
use SerEducacional\Services\EscolaService;
use SerEducacional\Validators\EscolaValidator;
use Yajra\Datatables\Datatables;

class EscolaController extends Controller
{
    /**
     * @var EscolaRepository
     */
    protected $repository;

    /**
     * @var EscolaService
     */
    private $service;

    /**
     * @var EscolaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Estado',
        'Cidade',
        'Bairro',
        'Coordenadoria',
        'Mantenedora',
        'Zona'

    ];

    /**
     * EscolaController constructor.
     * @param EscolaRepository $repository
     * @param EscolaService $service
     * @param EscolaValidator $validator
     */
    public function __construct(EscolaRepository $repository,
                                EscolaService $service,
                                EscolaValidator $validator)
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
        return view('escola.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('edu_escola')
            ->leftJoin('edu_coordenadoria', 'edu_coordenadoria.id', 'edu_escola.coordenadoria_id')
            ->leftJoin('edu_mantenedora', 'edu_mantenedora.id', 'edu_escola.mantenedora_id')
            ->select([
                'edu_escola.id',
                'edu_escola.codigo',
                'edu_escola.nome',
                'edu_escola.nome_abreviado',
                'edu_coordenadoria.nome as coordenadoria',
                'edu_mantenedora.nome as mantenedora'
            ]);
       
        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # Recuperando a escola
            $escola = $this->repository->find($row->id);

            # Variáveis de uso
            $html  = '';

            # Verificando a permissão de edição
            if($user->can('escola.update')) {
                $html  = '<a style="margin-right: 1%;" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
            }

            # Verificando a possibilidade de exclusão
            if(count($escola->cursos) == 0 && count($escola->alocacoes) == 0 && $user->can('escola.destroy')) {
                $html .= '<a style="margin-right: 3%;" href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Verificando a permissão de adicionar cursos
            /*if($user->can('escola.add.curso')) {
                # Html de adicionar cursos
                $html .= '<a style="margin-right: 3%;" title="Adicionar Cursos" id="btnModalAdicionarCursos" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            }*/

            # Html de adicionar cursos
            $html .= '<a title="Adicionar Dependência" id="btnModalAdicionarDependencias" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>';
            
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
        return view('escola.create', compact('loadFields'));
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

            #Validando a requisição
            $this->service->tratamentoCampos($data);

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
            $model = $this->repository->with('endereco.bairro.cidade.estado')->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('escola.edit', compact('model', 'loadFields'));
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

            #Validando a requisição
            $this->service->tratamentoCampos($data);

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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Escola deletada.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Servidor deleted.');
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
}