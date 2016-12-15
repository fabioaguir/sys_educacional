<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\PessoaJuridicaRepository;
use SerEducacional\Services\PessoaJuridicaService;
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
     */
    public function __construct(PessoaJuridicaRepository $repository,
                                PessoaJuridicaService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
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

            /*#Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);*/

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
        $rows = \DB::table('cgm')
            ->join('cgm_municipio', 'cgm.cgm_municipio_id', 'cgm_municipio.id')
            ->select([
                'cgm.id',
                'cgm.nome',
                'cgm.cnpj',
                'cgm.cpf',
                'cgm_municipio.nome as statusCgm'
            ])
            ->get();
        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            $html  = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editar</a> ';
            $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i>Deletar</a>';

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

            /*#Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);*/

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

        $cidades = \DB::table('cidades')
            ->join('estados', 'estados.id', '=', 'cidades.estados_id')
            ->select('cidades.id', 'cidades.nome')
            ->where('estados.id', $idEstado)
            ->get();

        return response()->json($cidades);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function findBairro(Request $request)
    {
        $idCidade = $request->get('id');

        $cidades = \DB::table('bairros')
            ->join('cidades', 'cidades.id', '=', 'bairros.cidades_id')
            ->select('bairros.id', 'bairros.nome')
            ->where('cidades.id', $idCidade)
            ->get();

        return response()->json($cidades);
    }
}