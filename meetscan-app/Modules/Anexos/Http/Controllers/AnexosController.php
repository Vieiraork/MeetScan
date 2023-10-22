<?php

namespace Modules\Anexos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Anexos\Http\Requests\AnexosCreateRequest;
use Modules\Anexos\Http\Requests\AnexosUpdateRequest;
use Modules\Anexos\Http\Services\AnexosService;
use Modules\Usuarios\Entities\Usuario;

class AnexosController extends Controller
{
    public function __construct(AnexosService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('anexos::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $usuarios = Usuario::pluck('id_usuarios', 'no_usuario');

        return view('anexos::create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     * @param AnexosCreateRequest $request
     * @return Renderable
     */
    public function store(AnexosCreateRequest $request)
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
        return view('anexos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('anexos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param AnexosUpdateRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(AnexosUpdateRequest $request, $id)
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
