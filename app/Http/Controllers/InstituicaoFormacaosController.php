<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\InstituicaoFormacaoCreateRequest;
use SerEducacional\Http\Requests\InstituicaoFormacaoUpdateRequest;
use SerEducacional\Repositories\InstituicaoFormacaoRepository;
use SerEducacional\Validators\InstituicaoFormacaoValidator;


class InstituicaoFormacaosController extends Controller
{

    /**
     * @var InstituicaoFormacaoRepository
     */
    protected $repository;

    /**
     * @var InstituicaoFormacaoValidator
     */
    protected $validator;

    public function __construct(InstituicaoFormacaoRepository $repository, InstituicaoFormacaoValidator $validator)
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
        $instituicaoFormacaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instituicaoFormacaos,
            ]);
        }

        return view('instituicaoFormacaos.index', compact('instituicaoFormacaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstituicaoFormacaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InstituicaoFormacaoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $instituicaoFormacao = $this->repository->create($request->all());

            $response = [
                'message' => 'InstituicaoFormacao created.',
                'data'    => $instituicaoFormacao->toArray(),
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
        $instituicaoFormacao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $instituicaoFormacao,
            ]);
        }

        return view('instituicaoFormacaos.show', compact('instituicaoFormacao'));
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

        $instituicaoFormacao = $this->repository->find($id);

        return view('instituicaoFormacaos.edit', compact('instituicaoFormacao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  InstituicaoFormacaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(InstituicaoFormacaoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $instituicaoFormacao = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'InstituicaoFormacao updated.',
                'data'    => $instituicaoFormacao->toArray(),
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
                'message' => 'InstituicaoFormacao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InstituicaoFormacao deleted.');
    }
}
