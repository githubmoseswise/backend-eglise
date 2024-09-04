<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRole;
use App\Models\RolePermission;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
