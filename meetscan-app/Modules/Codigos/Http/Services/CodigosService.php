<?php

namespace Modules\Codigos\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CodigosService
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            //throw $th;
            Alert::alert('Erro', '', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', '', 'success');
    }

    public function update(Request $request)
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