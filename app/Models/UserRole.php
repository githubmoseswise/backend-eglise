<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Role;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'role_id'];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
