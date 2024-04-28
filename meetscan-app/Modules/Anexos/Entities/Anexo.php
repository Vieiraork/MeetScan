<?php

namespace Modules\Anexos\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Usuarios\Entities\Usuario;

class Anexo extends Model
{
    protected $table      = 'tb_anexo';
    protected $primaryKey = 'id_anexo';
    public $incrementing  = true;
    public $timestamps    = false;
    protected $fillable   = [
        'ds_arquivo',
        'ds_link',
        'no_arquivo',
        'ds_caminho',
        'dt_inclusao',
        'id_usuario'
    ];

    CONST FIREBASE_FILE_DIRECTORY = "Images";

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
