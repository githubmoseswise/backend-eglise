<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'SuperAdmin', 'description' => 'Super administrateur avec un accès complet'],
            ['name' => 'Admin', 'description' => 'Administrateur avec des privilèges avancés'],
            ['name' => 'Secretaire', 'description' => 'Rôle de secrétaire pour la gestion des tâches administratives'],
            ['name' => 'Maitre de choeur', 'description' => 'Maître de chœur responsable de la gestion du chœur'],
            ['name' => 'Fidele', 'description' => 'Membre fidèle de la paroisse'],
            ['name' => 'Choriste', 'description' => 'Membre du chœur'],
        ];

        foreach ($roles as $role) {
            // Vérifiez si le rôle existe déjà
            if (!Role::where('name', $role['name'])->exists()) {
                Role::create($role);
            }
        }

    }
}
