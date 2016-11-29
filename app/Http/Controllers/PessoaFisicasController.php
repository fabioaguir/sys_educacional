<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\PessoaFisicaCreateRequest;
use SerEducacional\Http\Requests\PessoaFisicaUpdateRequest;
use SerEducacional\Repositories\PessoaFisicaRepository;
use SerEducacional\Validators\PessoaFisicaValidator;


class PessoaFisicasController extends Controller
{

    /**
     * @var PessoaFisicaRepository
     */
    protected $repository;

    /**
     * @var PessoaFisicaValidator
     */
    protected $validator;

    public function __construct(PessoaFisicaRepository $repository, PessoaFisicaValidator $validator)
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
        $pessoaFisicas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pessoaFisicas,
            ]);
        }

        return view('pessoaFisicas.index', compact('pessoaFisicas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PessoaFisicaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaFisicaCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $pessoaFisica = $this->repository->create($request->all());

            $response = [
                'message' => 'PessoaFisica created.',
                'data'    => $pessoaFisica->toArray(),
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
        $pessoaFisica = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pessoaFisica,
            ]);
        }

        return view('pessoaFisicas.show', compact('pessoaFisica'));
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

        $pessoaFisica = $this->repository->find($id);

        return view('pessoaFisicas.edit', compact('pessoaFisica'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PessoaFisicaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PessoaFisicaUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pessoaFisica = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'PessoaFisica updated.',
                'data'    => $pessoaFisica->toArray(),
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
                'message' => 'PessoaFisica deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PessoaFisica deleted.');
    }
}
