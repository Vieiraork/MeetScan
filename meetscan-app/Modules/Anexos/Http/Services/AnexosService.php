<?php

namespace Modules\Anexos\Http\Services;

use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Kreait\Firebase\Storage;
use Modules\Anexos\Entities\Anexo;
use Modules\Anexos\Http\Requests\AnexosCreateRequest;
use Modules\Anexos\Http\Requests\AnexosUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage as LaravelStorage;
use Kreait\Firebase\Auth\SignInResult;
use Kreait\Firebase\Contract\Auth as ContractAuth;

class AnexosService
{
    public function store(AnexosCreateRequest $request, Storage $storage, ContractAuth $auth)
    {
        $file      = $request->vl_arquivo;
        $extension = $file->extension();
        $imageName = $file->getClientOriginalName();
        $file->move(public_path("images\\"), $imageName);
        $image     = public_path("images\\$imageName");

        $anonymously = $auth->signInAnonymously();
        $firebase_file = $this->uploadImageToFirebase($request, $storage, $anonymously, $image, $imageName);

        try {
            DB::beginTransaction();
            Anexo::create([
                'no_arquivo'  => $imageName,
                'dt_inclusao' => Carbon::now(),
                'ds_arquivo'  => $request->ds_arquivo,
                'ds_caminho'  => $image,
                'id_usuario'  => Auth::user()->id_usuario,
                'ds_link'     => $firebase_file
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Alert::alert('Erro', 'Não foi possível inserir o novo anexo atrelado ao usuário', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', 'Anexo assoiado ao usuário com sucesso', 'success');
        return redirect()->route('anexos.index');
    }

    public function update(AnexosUpdateRequest $request, $id, Storage $storage, SignInResult $auth)
    {
        $anexo      = Anexo::where('id_anexo', '=', $id)->first();
        $no_arquivo = $anexo->no_arquivo;
        $file       = $request->vl_arquivo;
        $imageName  = $file->getClientOriginalName();

        if (strtoupper($imageName) == strtoupper($no_arquivo)) {
            Alert::alert('Erro', 'Não é possível enviar um arquivo com nome já existente no sistema', 'error');
            return back()->withInput();
        }

        try {
            DB::beginTransaction();
            $anexo->ds_arquivo = $request->ds_arquivo;

            if (!is_null($request->vl_arquivo)) {
                $storage->getBucket()->object(Anexo::FIREBASE_FILE_DIRECTORY."/".$no_arquivo)->delete();
                unlink($anexo->ds_caminho);
                $file->move(public_path("img\\files"), $imageName);
                $image     = public_path("img\\files\\$imageName");
                
                $anexo->ds_caminho = $image;
                $anexo->ds_link    = $this->uploadImageToFirebase($request, $storage, $auth, $image, $imageName);
            }
            $anexo->no_arquivo = $imageName.".".$file->extension();

            $anexo->update();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::alert('Erro', 'Não foi possível editar o anexo selecionado', 'error');
            return back()->withInput();
        }

        Alert::alert('Sucesso', 'Anexo atualizado com sucesso', 'success');
        return redirect()->route('anexos.index');
    }

    public function destroy($id_anexo, Storage $storage, SignInResult $auth)
    {
        $anexo      = Anexo::where('id_anexo', '=', $id_anexo)->first();
        $file_path  = $anexo->ds_caminho;
        $no_arquivo = $anexo->no_arquivo;

        try {
            DB::beginTransaction();
            $storage->getBucket()->object(Anexo::FIREBASE_FILE_DIRECTORY."/".$no_arquivo)->delete();
            unlink($file_path);
            Anexo::destroy($id_anexo);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode([
                'type' => 'error',
                'msg'  => $e->getMessage()
            ]);
        }

        if (is_file($file_path))
            unlink($file_path);

        return json_encode([
            'type' => 'success',
            'msg'  => 'Sucesso ao excluir o anexo'
        ]);
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

    private function uploadImageToFirebase(Request $request, Storage $storage, SignInResult $auth, $img, $original_name)
    {
        $file = fopen($img, 'r');

        try {
            $storage->getBucket()->upload($file, ['name' => 'Images/'.$original_name]);
        } catch (\Exception $e) {
            throw $e;
        }

        $file_link = $storage->getBucket()->object("Images/$original_name");
        $date_expires = new DateTime('2025-12-31');

        return $file_link->exists() ? $file_link->signedUrl($date_expires) : '';
    }
}