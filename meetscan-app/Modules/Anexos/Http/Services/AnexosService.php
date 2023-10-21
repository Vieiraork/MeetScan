<?php

namespace Modules\Anexos\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Anexos\Entities\Anexo;
use RealRashid\SweetAlert\Facades\Alert;

class AnexosService
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Anexo::create([
                'ds_arquivo' => $request->ds_arquivo,
                'ds_link'    => $request->ds_link,
                'dt_registro' => $request->dt_registro,
                'id_usuario'  => Auth::user()->id_usuarios
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
            Anexo::where('id_anexo', '=', $id)->update([
                'ds_arquivo'  => $request->ds_arquivo,
                'ds_link'     => $request->ds_link,
                'id_usuario'  => Auth::user()->id_usuarios
            ]);
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
            Anexo::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', '', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', '', 'success');
    }

    public function search(Request $request)
    {
        $no_arquivo = $request->no_arquivo;
        $dt_inicio  = $request->dt_incio;
        $dt_fim     = $request->dt_fim;

        $query = Anexo::with('usuario');

        $query->when($no_arquivo, function ($q) use ($no_arquivo) {
            return $q->where('ds_arquivo', 'LIKE', '%'.$no_arquivo.'%');
        });

        $query->when($dt_inicio && $dt_fim, function ($q) use ($dt_inicio, $dt_fim) {
            return $q->whereBetween('dt_registro', [$dt_inicio, $dt_fim]);
        });

        $query->orderBy('id_anexo');

        return json_encode($query->get());
    }
}