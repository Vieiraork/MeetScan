<?php

namespace Modules\Codigos\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Usuarios\Entities\Usuario;

class Codigo extends Model
{
    protected $table      = 'tb_codigo_acesso';
    protected $primaryKey = 'id_codigo_acesso';
    public $incrementing  = true;
    public $timestamps    = false;
    protected $fillable   = [
        'ds_codigo_acesso',
        'dt_inclusao',
        'dt_alteracao',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
