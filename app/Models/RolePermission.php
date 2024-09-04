<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = ['role_id', 'permission_id'];
    protected $table = 'role_permissions';


    public function role()
    {
        return $this->belongsTo(Role::class);
    }



    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
