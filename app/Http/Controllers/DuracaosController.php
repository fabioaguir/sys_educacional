<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\DuracaoCreateRequest;
use SerEducacional\Http\Requests\DuracaoUpdateRequest;
use SerEducacional\Repositories\DuracaoRepository;
use SerEducacional\Validators\DuracaoValidator;


class DuracaosController extends Controller
{

    /**
     * @var DuracaoRepository
     */
    protected $repository;

    /**
     * @var DuracaoValidator
     */
    protected $validator;

    public function __construct(DuracaoRepository $repository, DuracaoValidator $validator)
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
        $duracaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $duracaos,
            ]);
        }

        return view('duracaos.index', compact('duracaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DuracaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DuracaoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $duracao = $this->repository->create($request->all());

            $response = [
                'message' => 'Duracao created.',
                'data'    => $duracao->toArray(),
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
        $duracao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $duracao,
            ]);
        }

        return view('duracaos.show', compact('duracao'));
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

        $duracao = $this->repository->find($id);

        return view('duracaos.edit', compact('duracao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DuracaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(DuracaoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $duracao = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Duracao updated.',
                'data'    => $duracao->toArray(),
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
                'message' => 'Duracao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Duracao deleted.');
    }
}
