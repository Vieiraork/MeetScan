<?php

namespace Modules\Codigos\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Usuarios\Entities\Usuario;

class Codigo extends Model
{
    protected $table      = 'tb_codigo_acesso';
    protected $primaryKey = 'id_codigo_acesso';
    public $incrementing  = false;
    public $timestamps    = false;
    protected $fillable   = [
        'ds_codigo_acesso',
        'dt_registro',
        'dt_alteracao',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id_usuarios', 'id_usuario');
    }
}
