<?php

namespace Modules\Codigos\Http\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use Modules\Codigos\Entities\Codigo;
use Modules\Codigos\Http\Requests\CodigosCreateRequest;
use Modules\Codigos\Http\Requests\CodigosUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CodigosService
{
    public function store(CodigosCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            Codigo::create([
                'ds_codigo_acesso' => $request->ds_codigo_acesso,
                'dt_inclusao'      => Carbon::now(),
                'id_usuario'       => $request->id_usuario
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', 'Ocorreu um erro na atribuição de código para o usuário', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', "Código $request->ds_codigo_acesso 
        atraibuído ao usuário com sucesso", 'success');
        return redirect()->route('codigos.index');
    }

    public function update(CodigosUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            Codigo::where('id_codigo_acesso', '=', $id)->update([
                'ds_codigo_acesso' => $request->ds_codigo_acesso,
                'id_usuario'       => $request->id_usuario,
                'dt_alteracao'     => Carbon::now()
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::alert('Erro', 'Não foi possível atualizar o código', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', 'Código atualizado com suceso', 'success');
        return redirect()->route('codigos.index');
    }

    public function destroy($id_codigo)
    {
        try {
            DB::beginTransaction();
            Codigo::destroy($id_codigo);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode([
                'type' => 'error',
                'msg'  => 'Não foi possível excluir o código'
            ]);
        }
        
        return json_encode([
            'type' => 'success',
            'msg'  => 'Código excluído com sucesso'
        ]);
    }

    public function search(Request $request)
    {
        $ds_codigo  = $request->ds_codigo;
        $dt_inicio  = $request->dt_inicio;
        $dt_fim     = $request->dt_fim;
        $no_usuario = $request->no_usuario;

        $query = Codigo::with('usuario');

        $query->when($ds_codigo, function ($q) use ($ds_codigo) {
            return $q->where('ds_codigo', 'LIKE', '%'.$ds_codigo.'%');
        });

        $query->when($dt_inicio && $dt_fim, function ($q) use ($dt_inicio, $dt_fim) {
            return $q->whereBetween('dt_registro', [$dt_inicio, $dt_fim]);
        });

        $query->when($no_usuario, function ($q) use ($no_usuario) {
            return $q->whereHas('usuario', function ($q) use ($no_usuario) {
                return $q->where('no_usuario', 'LIKE', '%'.$no_usuario.'%');
            });
        });

        return json_encode($query->get());
    }
}