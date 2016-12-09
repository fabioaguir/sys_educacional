<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\CargoCreateRequest;
use SerEducacional\Http\Requests\CargoUpdateRequest;
use SerEducacional\Repositories\CargoRepository;
use SerEducacional\Validators\CargoValidator;


class CargosController extends Controller
{

    /**
     * @var CargoRepository
     */
    protected $repository;

    /**
     * @var CargoValidator
     */
    protected $validator;

    public function __construct(CargoRepository $repository, CargoValidator $validator)
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
        $cargos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cargos,
            ]);
        }

        return view('cargos.index', compact('cargos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CargoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CargoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cargo = $this->repository->create($request->all());

            $response = [
                'message' => 'Cargo created.',
                'data'    => $cargo->toArray(),
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
        $cargo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cargo,
            ]);
        }

        return view('cargos.show', compact('cargo'));
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

        $cargo = $this->repository->find($id);

        return view('cargos.edit', compact('cargo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CargoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CargoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cargo = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Cargo updated.',
                'data'    => $cargo->toArray(),
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
                'message' => 'Cargo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Cargo deleted.');
    }
}
