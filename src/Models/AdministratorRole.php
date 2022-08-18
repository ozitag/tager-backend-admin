<?php

namespace OZiTAG\Tager\Backend\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OZiTAG\Tager\Backend\Rbac\Models\Role;

class AdministratorRole extends Model
{
    use SoftDeletes;

    protected $table = 'tager_administrators_roles';

    public $fillable = [
        'role_id', 'administrator_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }
}
