<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\DisciplinaCreateRequest;
use SerEducacional\Http\Requests\DisciplinaUpdateRequest;
use SerEducacional\Repositories\DisciplinaRepository;
use SerEducacional\Services\DisciplinaService;
use SerEducacional\Validators\DisciplinaValidator;
use Yajra\Datatables\Datatables;


class DisciplinasController extends Controller
{

    /**
     * @var DisciplinaRepository
     */
    protected $repository;

    /**
     * @var DisciplinaValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [];

    /**
     * @var DisciplinaService
     */
    private $service;

    /**
     * DisciplinasController constructor.
     * @param DisciplinaRepository $repository
     * @param DisciplinaValidator $validator
     */
    public function __construct(DisciplinaRepository $repository,
                                DisciplinaValidator $validator,
                                DisciplinaService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Retorno para view
        return view('disciplina.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('disciplinas')
            ->select([
                'disciplinas.id',
                'disciplinas.nome',
                'disciplinas.codigo',
                'disciplinas.carga_horaria'
            ]);

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            # Variáveis de uso
            $html  = '<a style="" href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            $html .= '<a href="destroy/'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';

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
        return view('disciplina.create', compact('loadFields'));
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
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disciplina = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $disciplina,
            ]);
        }

        return view('disciplinas.show', compact('disciplina'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $disciplina = $this->repository->find($id);

        return view('disciplinas.edit', compact('disciplina'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DisciplinaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(DisciplinaUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $disciplina = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Disciplina updated.',
                'data'    => $disciplina->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Disciplina deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Disciplina deleted.');
    }
}
