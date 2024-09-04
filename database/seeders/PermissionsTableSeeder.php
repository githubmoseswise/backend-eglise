<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Définir les permissions avec des descriptions détaillées
        $permissions = [
            // Permissions pour le Super Admin (ajoutées pour contexte)
            [
                'name' => 'manage_users',
                'description' => 'Permet la gestion complète des comptes utilisateurs, y compris la création, la modification, et la suppression des comptes. Il inclut aussi la gestion des permissions et des rôles ainsi que la réinitialisation des mots de passe.'
            ],
            [
                'name' => 'manage_content',
                'description' => 'Inclut la création, modification, et suppression des pages, catégories, médias, et liens. Aussi, il permet le paramétrage des options SEO pour chaque page.'
            ],
            [
                'name' => 'manage_notifications',
                'description' => 'Autorise la création, planification, et envoi de notifications push, ainsi que la configuration des préférences de notification pour chaque utilisateur.'
            ],
            [
                'name' => 'view_statistics',
                'description' => 'Permet l\'accès aux statistiques détaillées telles que les téléchargements, les utilisateurs actifs, le temps passé, etc.'
            ],
            [
                'name' => 'manage_updates',
                'description' => 'Couvre la création, test, et publication des mises à jour de l\'application sur les différents stores.'
            ],
            [
                'name' => 'manage_backups',
                'description' => 'Autorise la planification et l\'exécution des sauvegardes régulières des données.'
            ],
            [
                'name' => 'manage_integrations',
                'description' => 'Permet l\'intégration de services tiers comme le paiement en ligne, la messagerie, et la cartographie.'
            ],
            [
                'name' => 'manage_settings',
                'description' => 'Inclut la configuration des paramètres de sécurité, de confidentialité, de langue, etc.'
            ],
            [
                'name' => 'generate_reports',
                'description' => 'Permet la génération de divers rapports, y compris financiers, d\'utilisation, et de performance.'
            ],
            [
                'name' => 'manage_support',
                'description' => 'Couvre la gestion des tickets d\'assistance, des FAQ, des tutoriels vidéo, etc.'
            ],
            [
                'name' => 'manage_exhortations',
                'description' => 'Autorise la création, modification, et suppression des exhortations (sermons, discours, etc.). Cela inclut la gestion des fichiers associés et des métadonnées, ainsi que l\'organisation des exhortations par date, auteur ou catégorie. Permet également la consultation des statistiques d\'utilisation.'
            ],


            // Permissions pour l'Admin (ajoutées pour contexte)
            [
                'name' => 'admin_manage_users',
                'description' => 'Permet la gestion des comptes utilisateurs, y compris la création, modification, et suppression des comptes, à l\'exception des super admins.'
            ],
            [
                'name' => 'admin_manage_content',
                'description' => 'Inclut la création, modification, et suppression des pages, catégories, médias, et liens.'
            ],
            [
                'name' => 'admin_manage_notifications',
                'description' => 'Autorise la création, planification, et envoi de notifications push.'
            ],
            [
                'name' => 'admin_view_statistics',
                'description' => 'Permet l\'accès aux statistiques d\'utilisation de l\'application.'
            ],
            [
                'name' => 'admin_manage_backups',
                'description' => 'Autorise la sauvegarde régulière des données.'
            ],
            [
                'name' => 'admin_manage_integrations',
                'description' => 'Permet l\'intégration de services tiers.'
            ],
            [
                'name' => 'admin_manage_settings',
                'description' => 'Inclut la configuration des paramètres de l\'application.'
            ],
            [
                'name' => 'admin_view_reports',
                'description' => 'Permet la consultation des rapports sur les activités de l\'application.'
            ],
            [
                'name' => 'admin_view_support',
                'description' => 'Permet l\'accès aux tickets d\'assistance et autres supports.'
            ],
            [
                'name' => 'admin_manage_exhortations',
                'description' => 'Autorise la création, modification, et suppression des exhortations (sermons, discours, etc.). Cela inclut la gestion des fichiers associés et des métadonnées, ainsi que la consultation des exhortations disponibles.'
            ],


            // Permissions pour le Secrétaire
            [
                'name' => 'secretary_manage_members',
                'description' => 'Permet l\'ajout, la modification, et la suppression des membres, ainsi que la gestion des informations personnelles et des dates importantes.'
            ],
            [
                'name' => 'secretary_manage_baptisms',
                'description' => 'Permet la planification des baptêmes, gestion des inscriptions des familles, coordination avec les membres du clergé, et envoi de notifications de rappel.'
            ],
            [
                'name' => 'secretary_manage_weekly_program',
                'description' => 'Permet la création et la gestion du programme hebdomadaire des messes et autres événements religieux, ainsi que la mise à jour des horaires et des lieux.'
            ],
            [
                'name' => 'secretary_manage_special_services',
                'description' => 'Permet la planification des cultes spéciaux, coordination avec les membres du clergé, et gestion des inscriptions et réservations.'
            ],
            [
                'name' => 'secretary_manage_donations',
                'description' => 'Permet la collecte des dons, la génération des reçus, et la gestion des rapports financiers.'
            ],
            [
                'name' => 'secretary_manage_volunteers',
                'description' => 'Permet la planification des horaires des bénévoles, la répartition des tâches, et la gestion des disponibilités.'
            ],
            [
                'name' => 'secretary_manage_resources',
                'description' => 'Permet la gestion des équipements, salles, et véhicules.'
            ],
            [
                'name' => 'secretary_manage_communications',
                'description' => 'Permet l\'envoi de messages, la gestion des annonces, et des newsletters.'
            ],
            [
                'name' => 'secretary_view_reports',
                'description' => 'Permet l\'accès aux rapports sur les activités de la paroisse.'
            ],
            [
                'name' => 'secretary_manage_exhortations',
                'description' => 'Permet la consultation des exhortations disponibles et l\'envoi de notifications pour les nouvelles exhortations.'
            ],

            // Permissions pour le Maître de Chœur
            [
                'name' => 'choir_manage_songs',
                'description' => 'Permet l\'ajout, la modification, et la suppression des chants, ainsi que la gestion des paroles et partitions.'
            ],
            [
                'name' => 'choir_manage_rehearsals',
                'description' => 'Permet la planification des horaires de répétition, la réservation des salles, et la gestion des présences.'
            ],
            [
                'name' => 'choir_manage_members',
                'description' => 'Permet l\'ajout, la modification, et la suppression des membres de la chorale, ainsi que la gestion des informations personnelles et des disponibilités.'
            ],
            [
                'name' => 'choir_manage_performances',
                'description' => 'Permet la planification des performances, la réservation des salles, et la gestion des invitations et inscriptions.'
            ],
            [
                'name' => 'choir_manage_communications',
                'description' => 'Permet l\'envoi de messages, la gestion des annonces et des newsletters.'
            ],

            // Permissions pour le Fidèle
            [
                'name' => 'parish_view_info',
                'description' => 'Permet la consultation des informations de la paroisse, telles que les horaires des messes, les événements, les annonces importantes, et les ressources spirituelles.'
            ],
            [
                'name' => 'parish_send_messages',
                'description' => 'Permet l\'envoi de messages aux membres, groupes de prière, et comités.'
            ],
            [
                'name' => 'parish_donate_online',
                'description' => 'Permet de réaliser des dons en ligne avec des moyens de paiement sécurisés.'
            ],
            [
                'name' => 'parish_register_events',
                'description' => 'Permet l\'inscription aux événements tels que les messes, baptêmes, mariages, et réunions.'
            ],
            [
                'name' => 'parish_join_prayer_groups',
                'description' => 'Permet la participation en ligne aux groupes de prière et la réception des notifications.'
            ],
            [
                'name' => 'parish_access_spiritual_resources',
                'description' => 'Permet l\'accès aux lectures bibliques, prières, chants religieux, et vidéos inspirantes.'
            ],
            [
                'name' => 'parish_view_calendars',
                'description' => 'Permet la consultation des calendriers paroissiaux et l\'ajout d\'événements au calendrier personnel.'
            ],
            [
                'name' => 'parish_view_announcements',
                'description' => 'Permet la consultation des annonces et la réponse aux appels à l\'action.'
            ],
            [
                'name' => 'parish_view_member_profiles',
                'description' => 'Permet la consultation des profils des membres et l\'envoi de messages privés.'
            ],
            [
                'name' => 'parish_view_exhortations',
                'description' => 'Permet l\'accès aux exhortations publiées (audio, vidéo, documents) avec options de lecture et téléchargement.'
            ],

            // Permissions pour le Choriste
            [
                'name' => 'chorister_view_songs',
                'description' => 'Permet l\'accès aux chants, paroles et partitions de la chorale.'
            ],
            [
                'name' => 'chorister_view_rehearsals',
                'description' => 'Permet la consultation des horaires, salles, et présences des répétitions.'
            ],
            [
                'name' => 'chorister_view_members',
                'description' => 'Permet l\'accès aux informations de contact et aux disponibilités des membres de la chorale.'
            ],
            [
                'name' => 'chorister_view_performances',
                'description' => 'Permet la consultation des horaires, salles et invitations des performances.'
            ],
            [
                'name' => 'chorister_view_communications',
                'description' => 'Permet l\'accès aux messages du maître de chœur, annonces, et newsletters.'
            ],
            [
                'name' => 'chorister_view_exhortations',
                'description' => 'Permet l\'accès aux exhortations publiées, avec options de lecture et téléchargement, si applicable.'
            ],
        
        ];

        // Insérer les permissions dans la base de données
        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
