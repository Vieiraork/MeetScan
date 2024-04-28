<?php

namespace Modules\Usuarios\Entities;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Perfil extends Model
{
    protected $table      = 'tb_perfil';
    protected $primaryKey = 'cd_perfil';
    public $incrementing  = false;
    public $timestamps    = false;
    protected $fillable   = [
        'cd_perfil',
        'ds_perfil',
    ];
}
