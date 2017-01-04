<?php

namespace SerEducacional\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @return mixed
     */
    public function login()
    {
        return view('authentication.login');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function attempt(Request $request)
    {
        # Validando os dados da requisição
        $this->validate($request, [
           'email' => 'required',
           'password' => 'required'
        ]);

        # Recuperando as credentials
        $credentials = $request->only(['email', 'password']);

        # Adicionando a opção de ativo
        $credentials['active'] = 1;

        # Auttenticação
        if(!Auth::attempt($credentials)) {
            return redirect()->back()
                ->withErrors('Credenciais inválidas')
                ->withInput();
        }

        # retorno
        return redirect('index');
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        # Logout
        Auth::logout();

        # Retorno para view
        return redirect('login');
    }
}
