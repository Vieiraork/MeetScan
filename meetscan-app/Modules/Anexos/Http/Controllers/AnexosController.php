<?php

namespace Modules\Anexos\Http\Controllers;

use DateTime;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Contract\Storage;
use Modules\Anexos\Entities\Anexo;
use Modules\Anexos\Http\Requests\AnexosCreateRequest;
use Modules\Anexos\Http\Requests\AnexosUpdateRequest;
use Modules\Anexos\Http\Services\AnexosService;
use Modules\Usuarios\Entities\Usuario;
use RealRashid\SweetAlert\Facades\Alert;

class AnexosController extends Controller
{
    protected $service;
    protected $storage;
    protected $auth;
    
    public function __construct(AnexosService $service, Storage $storage, Auth $auth)
    {
        $this->service = $service;
        $this->storage = $storage;
        $this->auth    = $auth;
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
        $usuarios = Usuario::pluck('id_usuario', 'no_usuario');

        return view('anexos::create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     * @param AnexosCreateRequest $request
     * @return Renderable
     */
    public function store(AnexosCreateRequest $request)
    {
        $file      = $request->file('vl_arquivo');
        $extension = $file->getClientOriginalExtension();

        if (!in_array($extension, ['jpg', 'png', 'jpge'])) {
            Alert::alert('Erro', 'São somente aceitos arquivos com extenções jpg e png', 'error');
            return back()->withInput();
        }

        return $this->service->store($request, $this->storage, $this->auth);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $anexo = Anexo::where('id_anexo', '=', $id)->with('usuario')->first();
        // $arr   = explode('\\', $anexo->ds_link);
        $image = $anexo->ds_link;

        return view('anexos::show', compact('anexo', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $usuarios = Usuario::pluck('id_usuario', 'no_usuario');
        $anexo    = Anexo::where('id_anexo', '=', $id)->with('usuario')->first();

        return view('anexos::edit', compact('anexo', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     * @param AnexosUpdateRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(AnexosUpdateRequest $request, $id)
    {
        return $this->service->update($request, $id, $this->storage, $this->auth->signInAnonymously());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return $this->service->destroy($id, $this->storage, $this->auth->signInAnonymously());
    }

    public function search(Request $request)
    {
        return $this->service->search($request);
    }
}
