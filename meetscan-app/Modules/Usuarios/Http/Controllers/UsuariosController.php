<?php

namespace Modules\Usuarios\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Usuarios\Entities\Perfil;
use Modules\Usuarios\Entities\Usuario;
use Modules\Usuarios\Http\Services\UsuariosService;

class UsuariosController extends Controller
{
    public function __construct(UsuariosService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $perfis = Perfil::get();

        return view('usuarios::index', compact('perfis'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('usuarios::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $usuario = Usuario::with('perfil')->where('id_usuarios', '=', $id)->first();

        return view('usuarios::show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('usuarios::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function search(Request $request)
    {
        return $this->service->search($request);
    }

    public function change($id)
    {
        return $this->service->change($id);
    }
}
