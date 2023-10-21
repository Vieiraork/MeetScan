<?php

namespace Modules\Anexos\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Usuarios\Entities\Usuario;

class Anexo extends Model
{
    protected $table      = 'tb_anexos';
    protected $primaryKey = 'id_anexo';
    public $incrementing  = true;
    public $timestamps    = false;
    protected $fillable   = [
        'ds_arquivo',
        'ds_link',
        'dt_registro',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id_usuarios', 'id_usuario');
    }
}
