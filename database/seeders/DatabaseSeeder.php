<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\PermissionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       // Appel des seeders pour les rôles et l'utilisateur SuperAdmin
       $this->call([
        RolesTableSeeder::class,
        SuperAdminSeeder::class,
        PermissionsTableSeeder::class,
        RolePermissionSeeder::class
    ]);
    }
}
