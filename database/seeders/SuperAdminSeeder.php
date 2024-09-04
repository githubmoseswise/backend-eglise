<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 
        // Création du rôle SuperAdmin s'il n'existe pas déjà
        $role = Role::firstOrCreate(
            ['name' => 'SuperAdmin'],
            ['description' => 'Super administrateur avec un accès complet']
        );

        // Création de l'utilisateur SuperAdmin
        $user = User::firstOrCreate(
            ['email' => 'superAdmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('95421330') // Mot de passe par défaut
            ]
        );

        // Attribution du rôle SuperAdmin à l'utilisateur
        UserRole::firstOrCreate([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        // Création du profil pour l'utilisateur SuperAdmin
        Profile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'phone_number' => '1234567890',
                'address' => '123 Admin Street'
            ]
        );

    }
}
