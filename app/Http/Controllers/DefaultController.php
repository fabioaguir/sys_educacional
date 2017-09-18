<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use SerEducacional\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $escolas = null;

        $escolas = \DB::table('edu_escola')->select(['edu_escola.nome', 'edu_escola.id']);

        if ($user->tipo_usuario_id == '4' || $user->tipo_usuario_id == '3') {
            $escolas->join('edu_alocacoes', 'edu_alocacoes.escola_id', '=', 'edu_escola.id');
            $escolas->where('edu_alocacoes.servidor_id', $user->edu_servidor_id);
        }

        $escolas = $escolas->get();

        \Session::put('escolas', $escolas);

        return view('default.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeEscola(Request $request)
    {
        $data = $request->get('escola');

        $escola = \DB::table('edu_escola')->select(['nome', 'id'])->where('id', $data)->first();

        \Session::put('escola', $escola);

        #Retorno para a view
        return redirect()->back();
    }

}