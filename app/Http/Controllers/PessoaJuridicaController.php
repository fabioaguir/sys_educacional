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
        'Estado'
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
                'cgm.rg',
                'cgm.cnpj',
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