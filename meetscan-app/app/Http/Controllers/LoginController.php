<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Service\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Usuarios\Entities\Usuario;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    protected $service;
    
    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
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
