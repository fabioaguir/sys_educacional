<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\FormaAvaliacaoRepository;
use SerEducacional\Repositories\NivelAlfabetizacaoRepository;
use SerEducacional\Services\FormaAvaliacaoService;
use SerEducacional\Validators\FormaAvaliacaoValidator;
use Yajra\Datatables\Datatables;


class FormaAvaliacoesController extends Controller
{

    /**
     * @var FormaAvaliacaoRepository
     */
    protected $repository;

    /**
     * @var FormaAvaliacaoValidator
     */
    protected $validator;

    /**
     * @var FormaAvaliacaoService
     */
    private $service;

    /**
     * @var array
     */
    private $loadFields = [
        'TipoResultado'
    ];

    /**
     * @var NivelAlfabetizacaoRepository
     */
    private $nivelAlfabetizacaoRepository;

    /**
     * FormaAvaliacoesController constructor.
     * @param FormaAvaliacaoService $service
     * @param FormaAvaliacaoRepository $repository
     * @param FormaAvaliacaoValidator $validator
     * @param NivelAlfabetizacaoRepository $nivelAlfabetizacaoRepository
     */
    public function __construct(FormaAvaliacaoService $service,
                                FormaAvaliacaoRepository $repository,
                                FormaAvaliacaoValidator $validator,
                                NivelAlfabetizacaoRepository $nivelAlfabetizacaoRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
        $this->nivelAlfabetizacaoRepository = $nivelAlfabetizacaoRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Retorno para view
        return view('formaAvaliacao.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('edu_formas_avaliacoes')
            ->join('edu_tipos_resultados', 'edu_tipos_resultados.id', '=', 'edu_formas_avaliacoes.tipo_resultado_id')
            ->select([
                'edu_formas_avaliacoes.id',
                'edu_formas_avaliacoes.nome',
                'edu_formas_avaliacoes.codigo',
                'edu_tipos_resultados.nome as tipo_resultado'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recupernado o usuário
            $user = Auth::user();

            # Variáveis de uso
            $html  = '';

            # Verificando a permissão de editar
            if($user->can('forma.avaliacao.update')) {
                $html  = '<a style="margin-right: 5%;" title="Editar Forma de Avaliação" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            }

            # Verificando a permissão de remorção
            if($user->can('forma.avaliacao.destroy')) {
                $html .= '<a href="destroy/' . $row->id . '" title="Remover Forma de Avaliação" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Retorno
            return $html;
        })->make(true);
    }


    /**
     * @return mixed
     */
    public function gridNiveis($id)
    {
        #Criando a consulta
        $rows = \DB::table('edu_niveis_alfabetizacao')
            ->join('edu_formas_avaliacoes', 'edu_formas_avaliacoes.id', '=', 'edu_niveis_alfabetizacao.forma_avaliacao_id')
            ->where('edu_formas_avaliacoes.id', $id)
            ->select([
                'edu_niveis_alfabetizacao.id',
                'edu_niveis_alfabetizacao.nome',
                'edu_niveis_alfabetizacao.codigo',
                \DB::raw('IF(edu_niveis_alfabetizacao.minimo_aprovacao = 1, "SIM", "NÃO") as minimo ')
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Variáveis de uso
            $html = '<a onclick="objNivelTable.destroyNivel('.$row->id .')" title="Remover Forma de Avaliação" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
        return view('formaAvaliacao.create', compact('loadFields'));
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
     * @param Request $request
     * @return mixed
     */
    public function storeNivel(Request $request)
    {
        try {
            # Recuperando os dados da requisição
            $dados = $request->all();

            # Regra para só existir um mínimo para aprovação
            if(isset($dados['minimo_aprovacao']) && $dados['minimo_aprovacao'] == 1) {
                \DB::table('edu_niveis_alfabetizacao')
                    ->where('forma_avaliacao_id', $dados['forma_avaliacao_id'])
                    ->update(['minimo_aprovacao' => 0]);
            }

            #Executando a ação
            $this->nivelAlfabetizacaoRepository->create($dados);

            #Retorno para a view
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Cadastro realizado com sucesso']);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $e->getMessage()]);
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
            return view('formaAvaliacao.edit', compact('model', 'loadFields'));
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
     * @param $id
     * @return mixed
     */
    public function destroyNivel($id)
    {
        try {
            #Executando a ação
            $this->nivelAlfabetizacaoRepository->delete($id);

            #Retorno para a view
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Remoção realizada com sucesso']);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
