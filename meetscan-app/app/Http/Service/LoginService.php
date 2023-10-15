<?php

namespace App\Http\Service;

use App\Helpers\Helpers;
use App\Http\Requests\AdminRegisterRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Usuarios\Entities\Usuario;
use RealRashid\SweetAlert\Facades\Alert;

class LoginService
{
    public function store(AdminRegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            Usuario::create([
                'no_usuario'  => $request->no_usuario,
                'ds_email'    => $request->ds_email,
                'ds_senha'    => Helpers::returnHashString($request->ds_senha),
                'cd_perfil'   => Usuario::ADMIN,
                'st_status'   => Usuario::ATIVO,
                'dt_registro' => Carbon::now()
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('', 'Não foi possível o cadastro de um novo usuário administrador', 'error');
            return redirect()->route('admin.create');
        }

        Alert::alert('', 'Usuário administrador registrado com sucesso', 'success');
        return redirect()->route('login');
    }
}