<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\PeriodoCreateRequest;
use SerEducacional\Http\Requests\PeriodoUpdateRequest;
use SerEducacional\Repositories\PeriodoRepository;
use SerEducacional\Validators\PeriodoValidator;


class PeriodosController extends Controller
{

    /**
     * @var PeriodoRepository
     */
    protected $repository;

    /**
     * @var PeriodoValidator
     */
    protected $validator;

    public function __construct(PeriodoRepository $repository, PeriodoValidator $validator)
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
        $periodos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $periodos,
            ]);
        }

        return view('periodos.index', compact('periodos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PeriodoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $periodo = $this->repository->create($request->all());

            $response = [
                'message' => 'Periodo created.',
                'data'    => $periodo->toArray(),
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
        $periodo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $periodo,
            ]);
        }

        return view('periodos.show', compact('periodo'));
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

        $periodo = $this->repository->find($id);

        return view('periodos.edit', compact('periodo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PeriodoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PeriodoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $periodo = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Periodo updated.',
                'data'    => $periodo->toArray(),
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
                'message' => 'Periodo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Periodo deleted.');
    }
}
