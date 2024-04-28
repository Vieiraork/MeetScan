<?php

namespace Modules\Codigos\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Codigos\Entities\Codigo;
use Modules\Codigos\Entities\Parametro;

class CodigosApiController
{
    public function index($ds_codigo)
    {
        $codigo         = Codigo::where('ds_codigo_acesso', '=', $ds_codigo)->with('usuario')->first();
        $token_telegram = Parametro::where('cd_parametro', '=', Parametro::AUTENTICACAO_TELEGRAM)->first();
        $id_chat        = Parametro::where('cd_parametro', '=', Parametro::CHAT_ID_TELEGRAM)->first();

        $msg = $codigo->usuario->no_usuario." Chegou em casa às ". date('d/m/Y H:i:s', strtotime(Carbon::now()));
        $url = "https://api.telegram.org/$token_telegram->vl_parametro/sendMessage?chat_id=$id_chat->vl_parametro&text=$msg";
        
        try {
            file_get_contents($url);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return response('Sucesso ao mandar mensagem de notificação', 200);
    }
}