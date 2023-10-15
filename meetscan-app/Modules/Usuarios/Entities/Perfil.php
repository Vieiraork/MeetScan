<?php

namespace Modules\Usuarios\Entities;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Perfil extends Model
{
    protected $table    = 'tb_perfil';
    protected $fillable = [
        'cd_perfil',
        'ds_perfil',
        'ds_leitura',
        'ds_escrita',
        'ds_exclusao',
        'ds_edica'
    ];
    public $incrementing = false;
    public $timestamps   = false;
}
