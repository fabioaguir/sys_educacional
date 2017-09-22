<?php

namespace SerEducacional\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GeniusTS\Roles\Traits\HasRoleAndPermission;
use GeniusTS\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'edu_servidor_id',
        'tipo_usuario_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servidor()
    {
        return $this->belongsTo(Servidor::class, 'edu_servidor_id');
    }
}
