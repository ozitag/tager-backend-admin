<?php

namespace OZiTAG\Tager\Backend\Admin\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use OZiTAG\Tager\Backend\Rbac\Models\Role;

class Administrator extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $table = 'tager_administrators';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'tager_administrator_roles','administrator_id', 'role_id');
    }
}
