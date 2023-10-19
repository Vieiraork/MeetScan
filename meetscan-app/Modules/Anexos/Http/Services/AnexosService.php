<?php

namespace Modules\Anexos\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AnexosService
{
    public function store(Request $request)
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

    public function update(Request $request, $id)
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

    public function destoy($id)
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