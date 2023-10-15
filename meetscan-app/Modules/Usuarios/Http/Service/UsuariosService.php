<?php

namespace Modules\Usuarios\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Usuarios\Entities\Usuario;
use RealRashid\SweetAlert\Facades\Alert;

class UsuariosService
{
    public function store()
    {
        try {
            DB::beginTransaction();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', 'Não foi possível cadastrar o usuário, verifique', 'error');
        }
    }

    public function update()
    {
        try {
            DB::beginTransaction();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', 'Não foi possível atualizar o usuário', 'error');
            return back()->withInput();
        }
    }

    public function search(Request $request)
    {
        $no_usuario = $request->no_usuario;
        $ds_email   = $request->ds_email;
        $cd_perfil  = $request->cd_perfil;
        $st_status  = $request->st_status;

        $query = Usuario::with('perfil');

        $query->when($no_usuario, function ($q) use ($no_usuario) {
            return $q->where('no_usuario', 'LIKE', '%'.$no_usuario.'%');
        });

        $query->when($ds_email, function ($q) use ($ds_email) {
            return $q->where('ds_email', 'LIKE', '%'.$ds_email.'%');
        });

        $query->when($cd_perfil, function ($q) use ($cd_perfil) {
            return $q->where('cd_perfil', '=', $cd_perfil);
        });

        $query->when($st_status, function ($q) use ($st_status) {
            return $q->where('st_status', '=', $st_status);
        });

        $result = $query->get();

        return json_encode($result);
    }

    public function changeStatus()
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}