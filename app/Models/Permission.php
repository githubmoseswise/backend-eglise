<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RolePermission;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relation plusieurs à plusieurs avec Role via la table pivot role_permissions
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
