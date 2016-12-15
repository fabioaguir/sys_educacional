<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use SerEducacional\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SerEducacional\Http\Requests\InstituicaoCreateRequest;
use SerEducacional\Http\Requests\InstituicaoUpdateRequest;
use SerEducacional\Repositories\InstituicaoRepository;
use SerEducacional\Services\InstituicaoService;
use SerEducacional\Validators\InstituicaoValidator;
use Yajra\Datatables\Datatables;


class InstituicaosController extends Controller
{

    /**
     * @var InstituicaoRepository
     */
    protected $repository;

    /**
     * @var InstituicaoValidator
     */
    protected $validator;

    /**
     * @var array
     */
    private $loadFields = [
        'Estado'
    ];

    /**
     * @var InstituicaoService
     */
    private $service;

    /**
     * InstituicaosController constructor.
     * @param InstituicaoRepository $repository
     * @param InstituicaoValidator $validator
     * @param InstituicaoService $service
     */
    public function __construct(InstituicaoRepository $repository,
                                InstituicaoValidator $validator,
                                InstituicaoService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit()
    {
        try {
            #Recuperando a empresa
            $model = $this->repository->find('1');

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('instituicao.edit', compact('model', 'loadFields'));
        } catch (\Throwable $e) {dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #tratando as rules
            $this->validator->replaceRules(ValidatorInterface::RULE_UPDATE, ":id", $id);

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            #Executando a ação
            $this->service->update($data, $id);

            #Retorno para a view
            return redirect()->back()->with("message", "Alteração realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        } catch (\Throwable $e) { dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

}
