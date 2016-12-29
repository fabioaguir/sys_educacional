<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\CursoFormacaoCreateRequest;
use SerEducacional\Http\Requests\CursoFormacaoUpdateRequest;
use SerEducacional\Repositories\CursoFormacaoRepository;
use SerEducacional\Validators\CursoFormacaoValidator;


class CursoFormacaosController extends Controller
{

    /**
     * @var CursoFormacaoRepository
     */
    protected $repository;

    /**
     * @var CursoFormacaoValidator
     */
    protected $validator;

    public function __construct(CursoFormacaoRepository $repository, CursoFormacaoValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $cursoFormacaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cursoFormacaos,
            ]);
        }

        return view('cursoFormacaos.index', compact('cursoFormacaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CursoFormacaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CursoFormacaoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cursoFormacao = $this->repository->create($request->all());

            $response = [
                'message' => 'CursoFormacao created.',
                'data'    => $cursoFormacao->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cursoFormacao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cursoFormacao,
            ]);
        }

        return view('cursoFormacaos.show', compact('cursoFormacao'));
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

        $cursoFormacao = $this->repository->find($id);

        return view('cursoFormacaos.edit', compact('cursoFormacao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CursoFormacaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CursoFormacaoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cursoFormacao = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'CursoFormacao updated.',
                'data'    => $cursoFormacao->toArray(),
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
                'message' => 'CursoFormacao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CursoFormacao deleted.');
    }
}
