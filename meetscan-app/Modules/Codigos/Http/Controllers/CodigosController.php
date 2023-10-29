<?php

namespace Modules\Codigos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Codigos\Entities\Codigo;
use Modules\Codigos\Http\Requests\CodigosCreateRequest;
use Modules\Codigos\Http\Requests\CodigosUpdateRequest;
use Modules\Codigos\Http\Services\CodigosService;
use Modules\Usuarios\Entities\Usuario;

class CodigosController extends Controller
{
    public function __construct(CodigosService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('codigos::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $usuarios = Usuario::where('cd_perfil', '=', Usuario::MORADOR)->pluck('id_usuarios', 'no_usuario');

        return view('codigos::create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CodigosCreateRequest $request
     * @return Renderable
     */
    public function store(CodigosCreateRequest $request)
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
        $codigo = Codigo::with('usuario')->where('id_codigo_acesso', '=', $id)->first();

        return view('codigos::show', compact('codigo'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $usuarios = Usuario::where('cd_perfil', '=', Usuario::MORADOR)->pluck('id_usuarios', 'no_usuario');
        $codigo   = Codigo::where('id_codigo_acesso', '=', $id)->first();

        return view('codigos::edit', compact('usuarios', 'codigo'));
    }

    /**
     * Update the specified resource in storage.
     * @param CodigosUpdateRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(CodigosUpdateRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function search(Request $request)
    {
        return $this->service->search($request);
    }
}