<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relation avec le modèle UserRole
    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }

    // Récupérer les rôles via UserRole
    public function roles()
    {
        return $this->hasManyThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }

    // Vérifier si l'utilisateur a un rôle spécifique
    public function hasRole($role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    // Assigner un rôle à l'utilisateur
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        return UserRole::firstOrCreate([
            'user_id' => $this->id,
            'role_id' => $role->id,
        ]);
    }

    public function hasPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }

    public function getUserPermissions(): array
    {
        // Récupérer les rôles de l'utilisateur
        $roles = $this->roles->pluck('name');

        // Initialiser un tableau pour les permissions
        $permissions = [];

        // Pour chaque rôle, récupérer les permissions associées
        foreach ($roles as $role) {
            $roleModel = Role::where('name', $role)->first();
            if ($roleModel) {
                // Récupérer les permissions associées à ce rôle
                $rolePermissions = $roleModel->permissions->pluck('name');
                // Ajouter les permissions au tableau
                $permissions = array_merge($permissions, $rolePermissions->toArray());
            }
        }

        // Supprimer les doublons du tableau de permissions
        $permissions = array_unique($permissions);

        return $permissions;
    }

}