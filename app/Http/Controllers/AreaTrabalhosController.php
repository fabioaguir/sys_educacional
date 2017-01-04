<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\AreaTrabalhoCreateRequest;
use SerEducacional\Http\Requests\AreaTrabalhoUpdateRequest;
use SerEducacional\Repositories\AreaTrabalhoRepository;
use SerEducacional\Validators\AreaTrabalhoValidator;


class AreaTrabalhosController extends Controller
{

    /**
     * @var AreaTrabalhoRepository
     */
    protected $repository;

    /**
     * @var AreaTrabalhoValidator
     */
    protected $validator;

    public function __construct(AreaTrabalhoRepository $repository, AreaTrabalhoValidator $validator)
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
        $areaTrabalhos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $areaTrabalhos,
            ]);
        }

        return view('areaTrabalhos.index', compact('areaTrabalhos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AreaTrabalhoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AreaTrabalhoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $areaTrabalho = $this->repository->create($request->all());

            $response = [
                'message' => 'AreaTrabalho created.',
                'data'    => $areaTrabalho->toArray(),
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
        $areaTrabalho = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $areaTrabalho,
            ]);
        }

        return view('areaTrabalhos.show', compact('areaTrabalho'));
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

        $areaTrabalho = $this->repository->find($id);

        return view('areaTrabalhos.edit', compact('areaTrabalho'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AreaTrabalhoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AreaTrabalhoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $areaTrabalho = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'AreaTrabalho updated.',
                'data'    => $areaTrabalho->toArray(),
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
                'message' => 'AreaTrabalho deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AreaTrabalho deleted.');
    }
}
