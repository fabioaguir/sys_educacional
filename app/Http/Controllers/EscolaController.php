<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Repositories\EscolaRepository;
use SerEducacional\Services\EscolaService;
use Yajra\Datatables\Datatables;

class EscolaController extends Controller
{
    /**
     * @var FuncaoRepository|EscolaRepository
     */
    protected $repository;

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
     * @var FuncaoService|EscolaService
     */
    private $service;

    /**
     * EscolaController constructor.
     * @param EscolaRepository $repository
     * @param EscolaService $service
     */
    public function __construct(EscolaRepository $repository,
                                EscolaService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
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