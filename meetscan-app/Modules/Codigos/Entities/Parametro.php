<?php

namespace Modules\Codigos\Entities;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table      = 'tb_parametro';
    protected $primaryKey = 'cd_parametro';
    public $incrementing  = false;
    public $timestamps    = false;
    protected $fillable   = [
        'cd_parametro',
        'vl_parametro',
        'ds_descricao',
        'dt_registro'
    ];

    const AUTENTICACAO_TELEGRAM = 1;
    const CHAT_ID_TELEGRAM = 2;
}