<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRole;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relation avec le modèle UserRole
    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    // Relation plusieurs à plusieurs avec Permission via la table pivot role_permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
