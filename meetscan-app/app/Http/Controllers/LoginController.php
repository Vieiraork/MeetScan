<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Service\LoginService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Usuarios\Entities\Usuario;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('ds_email', '=', $request->ds_email)->first();

        if ($usuario) {
            if (Helpers::checkIfHashIsEqual($usuario->ds_senha, $request->ds_senha)) {
                Auth::login($usuario);
                Alert::toast("Bem vindo(a) {$usuario->no_usuario}!", 'success');
                return redirect()->route('home');
            }

            Alert::alert('', 'Credenciais inválidas, por favor, verifique!', 'error');
            return back()->withInput();
        }

        Alert::alert('', 'E-mail não encontrado, por favor, ferique!', 'error');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function create()
    {
        $usuario = Usuario::where('cd_perfil', '=', Usuario::ADMIN)->first();

        if (!is_null($usuario)) {
            Alert::toast('Usuário administrador já registrado', 'warning');
            return redirect()->route('login');
        }

        return view('register.create');
    }

    public function store(AdminRegisterRequest $request)
    {
        return $this->service->store($request);
    }
}
