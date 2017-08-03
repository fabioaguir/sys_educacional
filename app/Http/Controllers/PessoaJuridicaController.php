<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\PessoaJuridicaRepository;
use SerEducacional\Services\PessoaJuridicaService;
use SerEducacional\Validators\PessoaJuridicaValidator;
use Yajra\Datatables\Datatables;

class PessoaJuridicaController extends Controller
{
    /**
     * @var PessoaJuridicaService
     */
    private $service;

    /**
     * @var PessoaJuridicaRepository
     */
    protected $repository;

    private $loadFields = [
        'CgmMunicipio',
        'Bairro',
        'Cidade',
        'Estado',
        'TipoEmpresa'
    ];

    /**
     * PessoaJuridicaController constructor.
     * @param PessoaJuridicaRepository $repository
     * @param PessoaJuridicaService $service
     * @param PessoaJuridicaValidator $validator
     */
    public function __construct(PessoaJuridicaRepository $repository,
                                PessoaJuridicaService $service,
                                PessoaJuridicaValidator $validator)
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
        return view('cgm.pessoaJuridica.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('cgm.pessoaJuridica.create', compact ('loadFields'));
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
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('gen_cgm')
            ->select([
                'gen_cgm.id',
                'gen_cgm.nome',
                'gen_cgm.cnpj',
            ])
            ->where('cpf', '=', null);
        
        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # Variáveis de uso
            $html  = '';

            # Verificando a permissão de editar
            if($user->can('pessoa.juridica.update')) {
                $html  = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
            }

            # Verificando a permissão de remorção
            if($user->can('pessoa.juridica.destroy')) {
                $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Retorno
            return $html;
        })->make(true);
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
            return view('cgm.pessoaJuridica.edit', compact('model', 'loadFields'));
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
    public function searchCnpj(Request $request)
    {
        try {
            #Declaração de variável de uso
            $result = false;
            #Dados vindo na requisição
            $pessoaJuridica = $request->all();

            #
            if (empty($pessoaJuridica['idModel'])) {
                #Consultando
                $pessoa = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.cnpj'
                    ])
                    ->where('gen_cgm.cnpj', $pessoaJuridica['value'])
                    ->get();

            } else {
                #Consultando
                $pessoa = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.id',
                        'gen_cgm.cnpj'
                    ])
                    ->where('gen_cgm.id', '!=' ,$pessoaJuridica['idModel'])
                    ->where('gen_cgm.cnpj', $pessoaJuridica['value'])
                    ->get();
            }

            if (count($pessoa) > 0 ) {
                $result = true;
            }

            #retorno para view
            return \Illuminate\Support\Facades\Response::json(['success' => $result]);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false,'msg' => $e->getMessage()]);
        }
    }
}