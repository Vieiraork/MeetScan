<?php

namespace Modules\Usuarios\Entities;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Modules\Codigos\Entities\Codigo;

class Usuario extends User
{
    use Notifiable;

    protected $table      = 'meetscan.tb_usuarios';
    protected $primaryKey = 'id_usuarios';
    protected $guard      = 'web';
    public $incrementing  = false;
    public $timestamps    = false;

    // Perfil de usuário
    const ADMIN   = 1;
    const MORADOR = 2;

    // Usuário ATIVO ou INATIVO
    const ATIVO   = 'A';
    const INATIVO = 'I';

    protected $fillable = [
        'no_usuario',
        'ds_email',
        'ds_senha',
        'ds_token',
        'st_status',
        'dt_registro',
        'dt_alteracao',
        'cd_perfil'
    ];

    protected $hidden = [
        'ds_senha', 'ds_token'
    ];

    protected $casts = [
        'dt_registro' => 'datetime',
        'dt_alteracao' => 'datetime'
    ];

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'cd_perfil', 'cd_perfil');
    }

    public function codigo()
    {
        return $this->hasOne(Codigo::class, 'id_usuarios', 'id_usuario');
    }
}
