<?php

namespace Modules\Codigos\Http\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Codigos\Entities\Codigo;
use RealRashid\SweetAlert\Facades\Alert;

class CodigosService
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Codigo::create([
                'ds_codigo_acesso' => $request->ds_codigo_acesso,
                'dt_registro'      => Carbon::now(),
                'id_usuario'       => Auth::user()->id_usuarios
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', '', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', '', 'success');
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Codigo::where('id_codigo', '=', $id)->update([
                'ds_codigo_acesso' => $request->ds_codigo_acesso,
                'id_usuario'       => Auth::user()->id_usuarios,
                'dt_alteracao'     => Carbon::now()
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', '', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', '', 'success');
    }

    public function destroy($id_codigo)
    {
        try {
            DB::beginTransaction();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', '', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', '', 'success');
    }
}