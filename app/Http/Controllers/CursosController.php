<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\CursoCreateRequest;
use SerEducacional\Http\Requests\CursoUpdateRequest;
use SerEducacional\Repositories\CursoRepository;
use SerEducacional\Validators\CursoValidator;


class CursosController extends Controller
{

    /**
     * @var CursoRepository
     */
    protected $repository;

    /**
     * @var CursoValidator
     */
    protected $validator;

    public function __construct(CursoRepository $repository, CursoValidator $validator)
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
        $cursos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cursos,
            ]);
        }

        return view('cursos.index', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CursoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CursoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $curso = $this->repository->create($request->all());

            $response = [
                'message' => 'Curso created.',
                'data'    => $curso->toArray(),
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
        $curso = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $curso,
            ]);
        }

        return view('cursos.show', compact('curso'));
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

        $curso = $this->repository->find($id);

        return view('cursos.edit', compact('curso'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CursoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CursoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $curso = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Curso updated.',
                'data'    => $curso->toArray(),
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
                'message' => 'Curso deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Curso deleted.');
    }
}
