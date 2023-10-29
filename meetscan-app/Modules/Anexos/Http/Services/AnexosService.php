<?php

namespace Modules\Anexos\Http\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Storage;
use Modules\Anexos\Entities\Anexo;
use Modules\Anexos\Http\Requests\AnexosCreateRequest;
use Modules\Anexos\Http\Requests\AnexosUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage as LaravelStorage;

class AnexosService
{
    public function store(AnexosCreateRequest $request, Storage $storage)
    {
        $image = $request->vl_arquivo;
        LaravelStorage::disk('local')->put($image, 'Content');
        // $file = $request->vl_arquivo.date('YmdHis');
        dd($image);

        try {
            DB::beginTransaction();
            $firebase_file = $this->uploadImageToFirebase($request, $storage);

            // Anexo::create([
            //     'ds_arquivo'  => $request->ds_arquivo,
            //     'ds_link'     => $request->ds_link,
            //     'dt_registro' => Carbon::now(),
            //     'id_usuario'  => $request->id_usuario
            // ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Alert::alert('Erro', '', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', 'Anexo assoiado ao usuário com sucesso', 'success');
        return redirect()->route('anexos.index');
    }

    public function update(AnexosUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            Anexo::where('id_anexo', '=', $id)->update([
                'ds_arquivo'  => $request->ds_arquivo
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

    private function uploadImageToFirebase(AnexosCreateRequest $request, Storage $storage)
    {
        $file_name = $request->vl_arquivo.date('YmdHis');

        try {
            $storage->getBucket()->upload($file_name);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}