<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Récupérer toutes les permissions
        $permissions = Permission::all()->keyBy('name');
        
        // Récupérer tous les rôles
        $roles = Role::all();
        
        // Associer les permissions aux rôles
        foreach ($roles as $role) {
            switch ($role->name) {
                case 'SuperAdmin':
                    // SuperAdmin et les permission
                    // $role->permissions()->sync($permissions->pluck('id')->toArray());
                    $role->permissions()->sync($permissions->whereIn('name', [
                        'manage_users',
                        'manage_content',
                        'manage_notifications',
                        'view_statistics',
                        'manage_updates',
                        'manage_backups',
                        'manage_integrations',
                        'manage_settings',
                        'generate_reports',
                        'manage_support',
                        'manage_exhortations'
                    ]));
                    break;

                case 'Admin':
                    // Admin a toutes les permissions sauf certaines
                    $role->permissions()->sync($permissions->whereIn('name', [
                        'admin_manage_users',
                        'admin_manage_content',
                        'admin_manage_notifications',
                        'admin_view_statistics',
                        'admin_manage_backups',
                        'admin_manage_integrations',
                        'admin_manage_settings',
                        'admin_view_reports',
                        'admin_view_support',
                        'admin_manage_exhortations'
                        
                    ]));
                    break;

                case 'Secretaire':
                    // Secrétaire a certaines permissions
                    $role->permissions()->sync($permissions->whereIn('name', [
                        'secretary_manage_members',
                        'secretary_manage_baptisms',
                        'secretary_manage_weekly_program',
                        'secretary_manage_special_services',
                        'secretary_manage_donations',
                        'secretary_manage_volunteers',
                        'secretary_manage_resources',
                        'secretary_manage_communications',
                        'secretary_view_reports',
                        'secretary_manage_exhortations',
                    ])->pluck('id')->toArray());
                    break;

                case 'Maitre de choeur':
                    // Maître de chœur a certaines permissions
                    $role->permissions()->sync($permissions->whereIn('name', [
                        'choir_manage_songs',
                        'choir_manage_rehearsals',
                        'choir_manage_members',
                        'choir_manage_performances',
                        'choir_manage_communications',
                    ])->pluck('id')->toArray());
                    break;

                case 'Fidele':
                    // Fidèle a certaines permissions
                    $role->permissions()->sync($permissions->whereIn('name', [
                        'parish_view_info',
                        'parish_send_messages',
                        'parish_donate_online',
                        'parish_register_events',
                        'parish_join_prayer_groups',
                        'parish_access_spiritual_resources',
                        'parish_view_calendars',
                        'parish_view_announcements',
                        'parish_view_member_profiles',
                        'parish_view_exhortations',
                    ])->pluck('id')->toArray());
                    break;

                case 'Choriste':
                    // Choriste a certaines permissions
                    $role->permissions()->sync($permissions->whereIn('name', [
                        'chorister_view_songs',
                        'chorister_view_rehearsals',
                        'chorister_view_members',
                        'chorister_view_performances',
                        'chorister_view_communications',
                        'chorister_view_exhortations',
                    ])->pluck('id')->toArray());
                    break;

                default:
                    // Aucun rôle par défaut
                    $role->permissions()->sync([]);
                    break;
            }
        }
    }
}
