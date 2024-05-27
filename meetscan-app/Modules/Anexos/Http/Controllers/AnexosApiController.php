<?php

namespace Modules\Anexos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Anexos\Entities\Anexo;

class AnexosApiController extends Controller
{
    public function search(Request $request) {
        $anexos = Anexo::select('ds_caminho')->get();

        return $anexos;
    }
}
