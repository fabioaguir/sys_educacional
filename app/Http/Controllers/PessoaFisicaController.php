<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\PessoaFisicaCreateRequest;
use SerEducacional\Http\Requests\PessoaFisicaUpdateRequest;
use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Repositories\ServidorRepository;
use SerEducacional\Validators\PessoaFisicaValidator;
use SerEducacional\Services\PessoaFisicaService;
use Yajra\Datatables\Datatables;

class PessoaFisicaController extends Controller
{
    /**
     * @var
     */
    private $service;

    /**
     * @var PessoaFisicaRepository
     */
    protected $repository;

    /**
     * @var ServidorRepository
     */
    protected $servidorRepository;

    /**
     * @var AlunoRepository
     */
    protected $alunoRepository;

    /**
     * @var PessoaFisicaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Sexo',
        'Nacionalidade',
        'CgmMunicipio',
        'EstadoCivil',
        'Escolaridade',
        'Bairro',
        'CategoriaCnh',
        'Cidade',
        'Estado'
    ];

    /**
     * PessoaFisicaController constructor.
     * @param PessoaFisicaService $service
     * @param PessoaFisicaRepository $repository
     * @param PessoaFisicaValidator $validator
     */
    public function __construct(PessoaFisicaService $service,
                                PessoaFisicaRepository $repository,
                                PessoaFisicaValidator $validator,
                                ServidorRepository $servidorRepository,
                                AlunoRepository $alunoRepository)
    {
        $this->repository = $repository;
        $this->servidorRepository = $servidorRepository;
        $this->alunoRepository = $alunoRepository;
        $this->validator  = $validator;
        $this->service    = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cgm.pessoaFisica.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('cgm.pessoaFisica.create', compact('loadFields'));
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
                'gen_cgm.rg',
                'gen_cgm.cpf',
            ])
            ->where('cnpj', '=', null);
        
        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Recuperando o usuário
            $user = Auth::user();

            # Variáveis de uso
            $html = '';

            #verificando se existe vinculo com outra tabela (servidores e alunos)
            $servidor = $this->servidorRepository->findWhere(['id_cgm' => $row->id]);
            $aluno = $this->alunoRepository->findWhere(['cgm_id' => $row->id]);


            # Verificando a permissão de editar
            if($user->can('pessoa.fisica.update')) {
                #botão editar
                $html  = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a> ';
            }

            #condição para que habilite a opção de remover
            if (count($servidor) == 0 && count($aluno) == 0 && $user->can('pessoa.fisica.destroy')) {
                $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            }

            # Retorno
            return $html;
        })->make(true);
    }

    /**
     * @return mixed
     */
    public function gridPesquisarPessoa()
    {
        #Criando a consulta
        $rows = \DB::table('gen_cgm')
            ->leftJoin('gen_endereco', 'gen_endereco.id', '=', 'gen_cgm.endereco_id')
            ->leftJoin('gen_bairros', 'gen_bairros.id', '=', 'gen_endereco.bairro_id')
            ->leftJoin('gen_cidades', 'gen_cidades.id', '=', 'gen_bairros.cidades_id')
            ->leftJoin('gen_estados', 'gen_estados.id', '=', 'gen_cidades.estados_id')
            ->whereNotIn('gen_cgm.id', function ($where) {
                $where->from('gen_cgm')
                    ->select('gen_cgm.id')
                    ->join('edu_alunos', 'edu_alunos.cgm_id', '=', 'gen_cgm.id');
                    //->where('edu_alunos.cgm_id', '=','gen_cgm.id');
            })
            ->whereNotIn('gen_cgm.id', function ($where) {
                $where->from('gen_cgm')
                    ->select('gen_cgm.id')
                    ->join('edu_servidor', 'edu_servidor.id_cgm', '=', 'gen_cgm.id');
                //->where('edu_alunos.cgm_id', '=','gen_cgm.id');
            })
            ->select([
                'gen_cgm.id',
                'gen_cgm.nome',
                'gen_cgm.mae',
                'gen_cgm.cpf',
                'gen_cgm.numero_nis',
                \DB::raw('DATE_FORMAT(gen_cgm.data_nascimento,"%d/%m/%Y") as data_nascimento'),
                'gen_cgm.rg',
                'gen_cgm.pai',
                'gen_cgm.fone',
                'gen_cgm.email',
                'gen_cgm.nacionalidade_id',
                'gen_cgm.naturalidade',
                'gen_cgm.sexo_id',
                'gen_cgm.inscricao_estadual',
                'gen_cgm.estado_civil_id',
                'gen_cgm.cgm_municipio_id',
                'gen_cgm.escolaridade_id',
                \DB::raw('DATE_FORMAT(gen_cgm.data_expedicao,"%d/%m/%Y") as data_expedicao'),
                \DB::raw('DATE_FORMAT(gen_cgm.data_vencimento_cnh,"%d/%m/%Y") as data_vencimento_cnh'),
                \DB::raw('DATE_FORMAT(gen_cgm.data_falecimento,"%d/%m/%Y") as data_falecimento'),
                'gen_cgm.num_cnh',
                'gen_cgm.cnh_categoria_id',
                'gen_cgm.carteira_prof',
                'gen_cgm.serie_carteira',
                'gen_cgm.numero_titulo',
                'gen_cgm.numero_sessao',
                'gen_cgm.numero_zona',

                'gen_endereco.id as endereco_id',
                'gen_endereco.logradouro',
                'gen_endereco.numero',
                'gen_endereco.complemento',
                'gen_endereco.cep',
                'gen_endereco.zona_id',
                'gen_bairros.nome as bairro',
                'gen_bairros.id as bairro_id',
                'gen_cidades.nome as cidade',
                'gen_cidades.id as cidade_id',
                'gen_estados.id as estado_id',
            ]);

        #Editando a grid
        return Datatables::of($rows)->make(true);
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
            return view('cgm.pessoaFisica.edit', compact('model', 'loadFields'));
        } catch (\Throwable $e) {dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param PessoaFisicaUpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
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
    public function searchCpf(Request $request)
    {
        try {
            #Declaração de variável de uso
            $result = false;
            #Dados vindo na requisição
            $pessoaFisica = $request->all();

            #
            if (empty($pessoaFisica['idModel'])) {
                #Consultando
                $pessoa = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.cpf'
                    ])
                    ->where('gen_cgm.cpf', $pessoaFisica['value'])
                    ->get();

            } else {
                #Consultando
                $pessoa = \DB::table('gen_cgm')
                    ->select([
                        'gen_cgm.id',
                        'gen_cgm.cpf'
                    ])
                    ->where('gen_cgm.id', '!=' ,$pessoaFisica['idModel'])
                    ->where('gen_cgm.cpf', $pessoaFisica['value'])
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