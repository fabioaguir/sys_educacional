<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\RegimeTrabalhoCreateRequest;
use SerEducacional\Http\Requests\RegimeTrabalhoUpdateRequest;
use SerEducacional\Repositories\RegimeTrabalhoRepository;
use SerEducacional\Validators\RegimeTrabalhoValidator;


class RegimeTrabalhosController extends Controller
{

    /**
     * @var RegimeTrabalhoRepository
     */
    protected $repository;

    /**
     * @var RegimeTrabalhoValidator
     */
    protected $validator;

    public function __construct(RegimeTrabalhoRepository $repository, RegimeTrabalhoValidator $validator)
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
        $regimeTrabalhos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $regimeTrabalhos,
            ]);
        }

        return view('regimeTrabalhos.index', compact('regimeTrabalhos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RegimeTrabalhoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RegimeTrabalhoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $regimeTrabalho = $this->repository->create($request->all());

            $response = [
                'message' => 'RegimeTrabalho created.',
                'data'    => $regimeTrabalho->toArray(),
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
        $regimeTrabalho = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $regimeTrabalho,
            ]);
        }

        return view('regimeTrabalhos.show', compact('regimeTrabalho'));
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

        $regimeTrabalho = $this->repository->find($id);

        return view('regimeTrabalhos.edit', compact('regimeTrabalho'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RegimeTrabalhoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RegimeTrabalhoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $regimeTrabalho = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'RegimeTrabalho updated.',
                'data'    => $regimeTrabalho->toArray(),
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
                'message' => 'RegimeTrabalho deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'RegimeTrabalho deleted.');
    }
}
